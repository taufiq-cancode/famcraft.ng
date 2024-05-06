<?php

namespace App\Http\Controllers;

use App\Models\Pricing;
use Illuminate\Support\Str;
use App\Models\IPEClearanceTransaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class IPEClearanceController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        $transactions = IPEClearanceTransaction::where('user_id', $user->id)
            ->orderBy('created_at', 'desc')
            ->get();
            
        return view('ipe-clearance', compact('transactions'));
    }

    public function store(Request $request)
    {
        try {
            DB::beginTransaction();

            $user = auth()->user();
    
            $request->validate([
                'ipe_category' => 'required|string|in:in-processing-error,still-in-process,new-enrollment-for-old-tracking-id',
                'tracking_id' => 'required|string|max:15',
            ]);

            $serviceFee = 0;
            $ipeCategory = $request->ipe_category;

            if ($ipeCategory === 'in-processing-error') {
                $fee = Pricing::where('item_name', 'in-processing-error')->first();
            } elseif ($ipeCategory === 'still-in-process') {
                $fee = Pricing::where('item_name', 'still-in-process')->first();
            } elseif ($ipeCategory === 'new-enrollment-for-old-tracking-id') {
                $fee = Pricing::where('item_name', 'new-enrollment-for-old-tracking-id')->first();
            }

            $serviceFee = $fee->price ?? null;

            if ($user->wallet->balance < $serviceFee) {
                DB::rollBack();
                return back()->with('error', 'Insufficient balance.');
            }
            $user->wallet->balance -= $serviceFee;
            $user->wallet->save();
    
            $transactionId = 'IPE' . rand(100000, 999999);
            while (IPEClearanceTransaction::where('transaction_id', $transactionId)->exists()) {
                $transactionId = 'IPE' . rand(100000, 999999);
            }
    
            $ipe = IPEClearanceTransaction::create([
                'ipe_category' => $request->ipe_category,
                'tracking_id' => $request->tracking_id,
                'user_id' => $user->id,
                'transaction_id' => $transactionId,
                'price' => $serviceFee,
            ]);
    
            if ($ipe){
                DB::commit();
                return back()->with('success', 'IPE clearance request submitted successfully.');
            }

        } catch(\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }

    public function view($ipeId)
    {
        $transaction = IPEClearanceTransaction::findOrFail($ipeId);
        return view('details.ipe', compact('transaction'));
    }

    public function update(Request $request, $ipeId)
    {
        try {
            $admin = auth()->user();
            if ($admin->role !== 'Administrator'){
                return back()->with('error', 'Unauthorized access');
            }
    
            $ipe = IPEClearanceTransaction::findOrFail($ipeId);
    
            $data = $request->validate([
                'status' => 'sometimes',
                'response' => 'sometimes',
                'response_text' => 'sometimes',
                'response_pdf.*' => 'sometimes|mimes:pdf|max:2048',
            ]);

    
            if ($request->hasFile('response_pdf')) {
                $filePaths = [];
                foreach ($request->file('response_pdf') as $file) {
                    $path = $file->store('response_pdfs');
                    $filePaths[] = $path;
                }
                $data['response_pdf'] = array_merge((array) $ipe->response_pdf, $filePaths);
            }
    
            $ipe->update($data);
    
            return back()->with('success', 'IPE clearance transaction updated successfully');
    
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }
    
}
