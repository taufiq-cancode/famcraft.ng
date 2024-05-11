<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Wallet;
use Illuminate\Validation\Rule;

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
             ->get();
        return view('admin.users', compact('users'));
    }

    public function view($userId)
    {
        try {
            $admin = auth()->user();
            if ($admin->role !== 'Administrator'){
                return back()->with('error', 'Unauthorized access');
            }

            $user = User::with(['wallet', 'payments' => function ($query) {
                $query->orderByDesc('created_at');
            }])->findOrFail($userId);
            
            if (!$user) {
                return back()->with('error', 'User not found.');
            }
            
            return view('details.user', compact('user'));
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }

    public function update(Request $request, $userId)
    {
        try {
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
            }

            if ($request->filled('status')) {
                $status = $request->input('status');
                $user->update(['status' => $status]);
            }

            if ($request->filled('role')) {
                $status = $request->input('role');
                $user->update(['role' => $status]);
            }

            return redirect()->route('view.user', $user->id)->with('success', 'User updated successfully.');
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage())->withInput();
        }
    }
}
