<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ReferralController extends Controller
{
    public function register(Request $request)
    {
        $request->validate([
            // Validation rules...
        ]);

        $referrer = User::where('referral_code', $request->query('ref'))->first();

        $user = User::create([
            'referral_code' => Str::random(10),
            'referred_by' => $referrer ? $referrer->id : null,
        ]);

        if ($referrer) {
            Referral::create([
                'referrer_id' => $referrer->id,
                'referred_id' => $user->id,
            ]);
        }

        // Log the user in or return response...
    }

}
