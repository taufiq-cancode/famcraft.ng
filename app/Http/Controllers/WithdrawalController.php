<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Withdrawal;
use App\Models\Wallet;
use Auth;
use Log;

class WithdrawalController extends Controller
{
    public function requestWithdrawal(Request $request)
    {
        $request->validate([
            'amount' => 'required|numeric|min:1',
            'account_number' => 'required|numeric|min:1',
            'account_name' => 'required|string',
            'bank_name' => 'required|string',
        ]);
    
        $user = Auth::user();
        $wallet = $user->wallet;
    
        if ($request->amount > $wallet->balance) {
            return back()->with('error', 'Insufficient funds in wallet.');
        }
    
        try {
            \DB::beginTransaction();

            Withdrawal::create([
                'user_id' => $user->id,
                'amount' => $request->amount,
                'account_number' => $request->account_number,
                'account_name' => $request->account_name,
                'bank_name' => $request->bank_name,
                'status' => 'pending',
            ]);
    
            $wallet->balance -= $request->amount;
            $wallet->save();
    
            \DB::commit();
            return back()->with('success', 'Withdrawal request submitted successfully.');
        } catch (\Exception $e) {
            \DB::rollBack();
            return back()->withErrors(['error' => 'Failed to submit withdrawal request. Please try again.']);
        }
    }

    public function view($withdrawalId)
    {
        try {
            $transaction = Withdrawal::findOrFail($withdrawalId);
            return view('details.withdrawal', compact('transaction'));
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }

    public function update(Request $request, $withdrawalId)
    {
        try {
            $admin = auth()->user();
            if ($admin->role !== 'Administrator'){
                return back()->with('error', 'Unauthorized access');
            }

            $withdrawal = Withdrawal::findOrFail($withdrawalId);

            $data = $request->validate([
                'status' => 'sometimes',
            ]);

            $withdrawal->update($data);

            return back()->with('success', 'Withdrawal Request updated successfully');

        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }
    
}
