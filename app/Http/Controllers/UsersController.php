<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Wallet;
use App\Models\Payment;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class UsersController extends Controller
{
    public function index()
    {
        $admin = auth()->user();
        if ($admin->role !== 'Administrator'){
            return back()->with('error', 'Unauthorized access');
        }

        $users = User::whereIn('role', ['Agent', 'User'])
             ->with('wallet')
             ->paginate(10);
        return view('admin.users', compact('users'));
    }

    public function view($userId)
    {
        try {
            $admin = auth()->user();
            if ($admin->role !== 'Administrator'){
                return back()->with('error', 'Unauthorized access');
            }
    
            $user = User::with(['wallet'])->findOrFail($userId);
            
            if (!$user) {
                return back()->with('error', 'User not found.');
            }
    
            $payments = $user->payments()->orderByDesc('created_at')->paginate(10);
    
            return view('details.user', compact('user', 'payments'));
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }
    

    public function update(Request $request, $userId)
    {
        try {
            DB::beginTransaction();

            $admin = auth()->user();
            if ($admin->role !== 'Administrator'){
                return back()->with('error', 'Unauthorized access');
            }
            
            $request->validate([
                'topup_amount' => 'nullable|numeric|min:0',
                'status' => 'sometimes|in:active,inactive',
                'role' => 'sometimes|in:Agent,User',
            ]);

            $user = User::findOrFail($userId);

            if ($request->filled('topup_amount')) {
                $topupAmount = $request->input('topup_amount');
                $user->wallet->increment('balance', $topupAmount);

                Payment::create([
                    'trxref' => Str::uuid(),
                    'reference' => Str::random(10),
                    'user_id' => $user->id,
                    'amount' => $topupAmount,
                    'payment_for' => 'wallet-top-up',
                    'payment_type' => 'admin-top-up',
                    'status' => 'completed',
                ]);
            }

            if ($request->filled('status')) {
                $status = $request->input('status');
                $user->update(['status' => $status]);
            }

            if ($request->filled('role')) {
                $role = $request->input('role');
                $user->update(['role' => $role]);
            }

            DB::commit();

            return redirect()->route('view.user', $user->id)->with('success', 'User updated successfully.');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', $e->getMessage())->withInput();
        }
    }

}
