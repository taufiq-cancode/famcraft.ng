<?php

namespace App\Http\Controllers;

use App\Models\Pricing;
use App\Models\VerificationTransaction;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
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
            DB::beginTransaction();

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

            $serviceFee = 0;
            $slipFee = 0;
            
            $service = Pricing::where('item_name', 'per-verification-request')->first();
            $serviceFee = $service->price ?? null;

            $slipType = $data['slip_type'];
            if ($slipType === 'premium-slip') {
                $slip = Pricing::where('item_name', 'premium-slip')->first();
            } elseif ($slipType === 'standard-slip') {
                $slip = Pricing::where('item_name', 'standard-slip')->first();
            } elseif ($slipType === 'improved-nin-slip') {
                $slip = Pricing::where('item_name', 'improved-nin-slip')->first();
            } elseif ($slipType === 'basic-slip') {
                $slip = Pricing::where('item_name', 'basic-slip')->first();
            }

            $slipFee = $slip->price ?? null;
            $cost = $serviceFee + $slipFee;

            if ($user->wallet->balance < $cost) {
                DB::rollBack();
                return back()->with('error', 'Insufficient balance.');
            }
            $user->wallet->balance -= $cost;
            $user->wallet->save();

            $transactionId = 'VER' . rand(100000, 999999);
            while (VerificationTransaction::where('transaction_id', $transactionId)->exists()) {
                $transactionId = 'VER' . rand(100000, 999999);
            }

            $data['transaction_id'] = $transactionId;
            $data['price'] = $cost;

            $verification = VerificationTransaction::create($data);
    
            // $verifyAPI = $this->submitVerification($verification);

            if ($verification) {
                DB::commit();
                return back()->with('success', 'Verification request submitted successfully.');
            }

        } catch(ValidationException $e) {
            DB::rollBack();
            return back()->with('error', $e->getMessage());
        }
    }

    // private function submitVerification(VerificationTransaction $verification)
    // {
    //     $endpoint = '';
    //     switch ($verification->method) {
    //         case 'by-demographics':
    //             $endpoint = 'https://directverify.com.ng/api/doc/index.php';
    //             break;
    //         case 'by-phone':
    //             $endpoint = 'https://directverify.com.ng/api/pnv/index.php';
    //             break;
    //         case 'by-nin':
    //             $endpoint = 'https://directverify.com.ng/api/nin/index.php';
    //             break;
    //         default:
    //             return null;
    //     }

    //     $requestData = [];
    //     switch ($verification->method) {
    //         case 'by-demographics':
    //             break;
    //         case 'by-phone':
    //             break;
    //         case 'by-nin':
    //             break;
    //         default:
    //             return null;
    //     }

    //     $response = Http::withHeaders([
    //         'Authorization' => 'Bearer ' . env('DIRECTVERIFY_API_KEY'),
    //         'Content-Type' => 'application/json',
    //     ])->post($endpoint, $requestData);

    //     if ($response->successful()) {
    //         $responseData = $response->json();
    //         if (isset($responseData['transaction_id'])) {
    //             $transactionId = $responseData['transaction_id'];
    //             $verification->update(['transaction_id' => $transactionId]);
    //             return $transactionId;
    //         } else {
    //             return null;
    //         }
    //     } else {
    //         return null;
    //     }
    // }

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
