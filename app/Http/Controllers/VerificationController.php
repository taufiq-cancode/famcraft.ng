<?php

namespace App\Http\Controllers;

use App\Models\VerificationTransaction;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

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

            $transactionId = 'VER' . rand(100000, 999999);
            while (VerificationTransaction::where('transaction_id', $transactionId)->exists()) {
                $transactionId = 'VER' . rand(100000, 999999);
            }

            $data['transaction_id'] = $transactionId;

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
        return view('details.verification', compact('transaction'));
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
                $data['response_pdf'] = array_merge((array) $verification->response_pdf, $filePaths);
            }

            $verification->update($data);

            return back()->with('success', 'Verification transaction updated successfully');

        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }
}
