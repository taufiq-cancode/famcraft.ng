<?php

namespace App\Http\Controllers;

use App\Models\Pricing;
use App\Models\VerificationTransaction;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class VerificationV2Controller extends Controller
{
    public function index()
    {
        return back()->with('error', 'Network unavailable.');
        // $user = auth()->user();
        // $transactions = VerificationTransaction::where('user_id', $user->id)
        //                                     ->where('verification_type', 'v2')
        //                                     ->orderBy('created_at', 'desc')
        //                                     ->paginate(10);
        // return view('verification-2', compact('transactions'));
    }

    public function store(Request $request)
    {
        try {
            DB::beginTransaction();

            $user = auth()->user();

            $data = $request->validate([
                'method' => 'required|string|in:by-demographics,by-phone,by-nin',
                'slip_type' => 'required|string|in:premium-slip,standard-slip,improved-nin-slip,basic-slip,nvs-slip',
                'nin' => 'nullable|integer',
                'surname' => 'nullable|string|max:255',
                'firstname' => 'nullable|string|max:255',
                'gender' => 'nullable|string|in:male,female',
                'dob' => 'nullable|date',
                'phone' => 'nullable|string',
            ]);

            $data['user_id'] = $user->id;
            $data['verification_type'] = 'v2';

            if (!empty($data['dob'])) {
                $data['dob'] = Carbon::createFromFormat('Y-m-d', $request->dob)->format('d-m-Y');
                $formattedDateForDB = $request->dob;
            } else {
                $formattedDateForDB = null;
            }

            $data['dob'] = $formattedDateForDB;

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

            if ($verification){
                DB::commit();
                return back()->with('success', 'Verification request submitted successfully.');
            }

        } catch(ValidationException $e) {
            DB::rollBack();
            return back()->with('error', $e->getMessage());
        }
    }

    public function view($verificationId)
    {
        $transaction = VerificationTransaction::findOrFail($verificationId);
        return view('details.verification-2', compact('transaction'));
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
                    $path = $file->store('response_pdfs', 'public');
                    $filePaths[] = $path;
                }
                $data['response_pdf'] = array_merge((array) $verification->response_pdf, $filePaths);
            }

            $verification->update($data);

            return back()->with('success', 'Verification transaction updated successfully');

        } catch (Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }
}
