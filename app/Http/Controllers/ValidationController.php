<?php

namespace App\Http\Controllers;

use App\Models\Pricing;
use App\Models\ValidationTransaction;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;


class ValidationController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $transactions = ValidationTransaction::where('user_id', $user->id)
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('validation', compact('transactions'));
    }

    public function store(Request $request)
    {
        try {
            DB::beginTransaction();

            $user = auth()->user();
    
            $request->validate([
                'nin' => 'required|max:15',
                'validation_category' => 'required|string|in:no-record-found,update-record,validation-modification,v-nin-validation,photograph-error,by-pass-nin',
                'validation_purpose' => 'required|string|in:bank,sim,passport,others',
            ]);

            $serviceFee = 0;
            $validationCategory = $request->validation_category;

            if ($validationCategory === 'no-record-found') {
                $fee = Pricing::where('item_name', 'no-record-found')->first();
            } elseif ($validationCategory === 'update-record') {
                $fee = Pricing::where('item_name', 'update-record')->first();
            } elseif ($validationCategory === 'validation-modification') {
                $fee = Pricing::where('item_name', 'validation-modification')->first();
            } elseif ($validationCategory === 'v-nin-validation') {
                $fee = Pricing::where('item_name', 'v-nin-validation')->first();
            } elseif ($validationCategory === 'photograph-error') {
                $fee = Pricing::where('item_name', 'photograph-error')->first();
            } elseif ($validationCategory === 'by-pass-nin') {
                $fee = Pricing::where('item_name', 'by-pass-nin')->first();
            }

            $serviceFee = $fee->price ?? null;

            if ($user->wallet->balance < $serviceFee) {
                DB::rollBack();
                return back()->with('error', 'Insufficient balance.');
            }
            $user->wallet->balance -= $serviceFee;
            $user->wallet->save();

            $transactionId = 'VAL' . rand(100000, 999999);
            while (ValidationTransaction::where('transaction_id', $transactionId)->exists()) {
                $transactionId = 'VAL' . rand(100000, 999999);
            }
            
            $validation = ValidationTransaction::create([
                'nin' => $request->nin,
                'validation_category' => $request->validation_category,
                'validation_purpose' => $request->validation_purpose,
                'user_id' => $user->id,
                'transaction_id' => $transactionId,
                'price' => $serviceFee
            ]);
    
            if ($validation){
                DB::commit();
                return back()->with('success', 'Validation request submitted successfully.');
            }

        } catch(\Exception $e) {
            DB::rollBack();
            return back()->with('error', $e->getMessage());
        }
    }

    public function view($validationId)
    {
        $transaction = ValidationTransaction::findOrFail($validationId);
        return view('details.validation', compact('transaction'));
    }

    public function update(Request $request, $validationId)
    {
        try {
            $admin = auth()->user();
            if ($admin->role !== 'Administrator'){
                return back()->with('error', 'Unauthorized access');
            }

            $validation = ValidationTransaction::findOrFail($validationId);

            $data = $request->validate([
                'status' => 'sometimes',
                'response' => 'sometimes',
                'response_text' => 'sometimes',
                'response_pdf.*' => 'sometimes|mimes:pdf|max:2048',
            ]);

            if ($request->hasFile('response_pdf')) {
                $filePaths = [];
                foreach ($request->file('response_pdf') as $file) {
                    $path = $file->store('response_pdfs', 'public');
                    $filePaths[] = $path;
                }
                $data['response_pdf'] = array_merge((array) $validation->response_pdf, $filePaths);
            }
            $validation->update($data);

            return back()->with('success', 'Validation transaction updated successfully');

        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }
}
