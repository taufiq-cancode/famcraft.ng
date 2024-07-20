<?php

namespace App\Http\Controllers;

use App\Models\Referral;
use App\Models\User;
use App\Models\Wallet;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class ReferralController extends Controller
{
    public function showReferralRegistrationForm(Request $request)
    {
        $referralCode = $request->query('ref', null);
        return view('auth.register-ref', compact('referralCode'));
    }

    public function register(Request $request)
    {
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'phone' => 'required|numeric|unique:users,phone',
            'email' => 'required|string|email|max:255|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
        ]);
    
        $referralCode = Str::random(10);
    
        DB::beginTransaction();
    
        try {
            $user = User::create([
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'phone' => $request->phone,
                'email' => $request->email,
                'password' => bcrypt($request->password),
                'referral_code' => $referralCode,
            ]);
    
            if ($request->has('ref')) {
                $referrer = User::where('referral_code', $request->input('ref'))->first();
    
                if ($referrer) {
                    $user->referred_by = $referrer->id;
                    $user->save();
    
                    Referral::create([
                        'referrer_id' => $referrer->id,
                        'referred_id' => $user->id,
                    ]);
                }
            }
    
            Wallet::create([
                'user_id' => $user->id,
                'balance' => 0.00,
            ]);
    
            DB::commit();
    
            auth()->login($user);
    
            return redirect()->route('dashboard');
        } catch (\Exception $e) {
            DB::rollBack();
    
            \Log::error('Registration error: ' . $e->getMessage());
            return back()->withErrors(['error' => 'Registration failed. Please try again.']);
        }
    }   
}
