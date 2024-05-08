<?php

namespace App\Http\Controllers;

use App\Models\Pricing;
use App\Models\PUKTransaction;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;


class PUKController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $transactions = PUKTransaction::where('user_id', $user->id)->get();
        return view('puk', compact('transactions'));
    }

    public function store(Request $request)
    {
        try {
            DB::beginTransaction();

            $user = auth()->user();
    
            $request->validate([
                'phone' => 'required|max:22',
                'fullname' => 'required|string|max:255',
                'dob' => 'required|date',
            ]);

            $serviceFee = 0;

            $service = Pricing::where('item_name', 'puk-retrieval')->first();
            $serviceFee = $service->price ?? null;

            if ($user->wallet->balance < $serviceFee) {
                DB::rollBack();
                return back()->with('error', 'Insufficient balance');
            }

            $user->wallet->balance -= $serviceFee;
            $user->wallet->save();

            $transactionId = 'PUK' . rand(100000, 999999);
            while (PUKTransaction::where('transaction_id', $transactionId)->exists()) {
                $transactionId = 'PUK' . rand(100000, 999999);
            }
    
            $puk_transaction = PUKTransaction::create([
                'phone' => $request->phone,
                'fullname' => $request->fullname,
                'dob' => $request->dob,
                'user_id' => $user->id,
                'price' => $service->price,
                'transaction_id' => $transactionId
            ]);
    
            DB::commit();
            if ($puk_transaction){
                return back()->with('success', 'PUK retrieval requested successfully.');
            }

        } catch(\Exception $e) {
            DB::rollBack();
            return back()->with('error', $e->getMessage());
        }
    }

    public function view($pukTransactionId)
    {
        $transaction = PUKTransaction::findOrFail($pukTransactionId);
        return view('details.puk', compact('transaction'));
    }

    public function update(Request $request, $pukTransactionId)
    {
        try {
            $admin = auth()->user();
            if ($admin->role !== 'Administrator'){
                return back()->with('error', 'Unauthorized access');
            }

            $puk_transaction = PUKTransaction::findOrFail($pukTransactionId);

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
                $data['response_pdf'] = array_merge((array) $puk_transaction->response_pdf, $filePaths);
            }
            $puk_transaction->update($data);

            return back()->with('success', 'PUK Transaction updated successfully');

        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }
}
