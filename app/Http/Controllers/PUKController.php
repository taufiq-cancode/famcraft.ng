<?php

namespace App\Http\Controllers;

use App\Models\PUKTransaction;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

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
            $user = auth()->user();
    
            $request->validate([
                'phone' => 'required|max:22',
                'fullname' => 'required|string|max:255',
                'dob' => 'required|date',
            ]);

            $transactionId = 'PUK' . rand(100000, 999999);
            while (PUKTransaction::where('transaction_id', $transactionId)->exists()) {
                $transactionId = 'PUK' . rand(100000, 999999);
            }
    
            $puk_transaction = PUKTransaction::create([
                'phone' => $request->phone,
                'fullname' => $request->fullname,
                'dob' => $request->dob,
                'user_id' => $user->id,
                'amount' => 0,
                'transaction_id' => $transactionId
            ]);
    
            if ($puk_transaction){
                return back()->with('success', 'PUK retrieval requested successfully.');
            }

        } catch(\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }

    public function view($pukTransactionId)
    {
        $transaction = PUKTransaction::findOrFail($pukTransactionId);
        return view('admin.view-puk', compact('transaction'));
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
                'response' => 'sometimes'
            ]);

            $puk_transaction->update($data);

            return back()->with('success', 'PUK Transaction updated successfully');

        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }
}
