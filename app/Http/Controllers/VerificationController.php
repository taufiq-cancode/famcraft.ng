<?php

namespace App\Http\Controllers;

use App\Models\VerificationTransaction;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Log;


class VerificationController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $transactions = VerificationTransaction::where('user_id', $user->id)->get();
        return view('verification', compact('transactions'));
    }

    public function store(Request $request)
    {
        try {
            $user = auth()->user();
    
            $data = $request->validate([
                'method' => 'required|string|in:by-demographics,by-phone,by-nin',
                'slip_type' => 'required|string|in:premium-slip,standard-slip,improved-nin-slip,basic-slip',
                'nin' => 'nullable|integer',
                'surname' => 'nullable|string|max:255',
                'firstname' => 'nullable|string|max:255',
                'gender' => 'nullable|string|in:male,female',
                'dob' => 'nullable|date',
                'phone' => 'nullable|string',
            ]);

            $data['user_id'] = $user->id;

            $verification = VerificationTransaction::create($data);
    
            if ($verification){
                return back()->with('success', 'Verification request submitted successfully.');
            }

        } catch(ValidationException $e) {
            Log::error($e->getMessage());
            return back()->with('error', $e->getMessage());
        }
    }

    public function view($verificationId)
    {
        $transaction = VerificationTransaction::findOrFail($verificationId);
        return view('admin.verification', compact('transaction'));
    }

    public function update(Request $request, $verificationId)
    {
        try {
            $admin = auth()->user();
            if ($admin->role !== 'Administrator'){
                return back()->with('error', 'Unauthorized access');
            }

            $verification = VerificationTransaction::findOrFail($verificationId);

            $data = $request->validate([
                'status' => 'sometimes',
                'response' => 'sometimes'
            ]);

            $verification->update($data);

            return back()->with('success', 'Verification transaction updated successfully');

        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }
}
