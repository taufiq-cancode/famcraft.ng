<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use App\Models\User;
use App\Models\Wallet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;

class PaymentController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        $transactions = Payment::where('user_id', $user->id)
            ->orderBy('created_at', 'desc')
            ->get();

        return view('wallet', compact('transactions'));
    }
    // public function initializeTransaction(Request $request)
    // {
    //     try{
    //         $amount_to_kobo = $request->input('amount') * 100;

    //         $fields = [
    //             'email' => $request->input('email'),
    //             'amount' => $amount_to_kobo,
    //             'callback_url' => "https://famcraft.ng/payment-status",
    //             'metadata' => [
    //                 "cancel_action" => "https://famcraft.ng/payment-cancelled",
    //             ]
    //         ];

    //         if ($request->filled('payment_for')) {
    //             $fields['metadata']['payment_for'] = $request->input('payment_for');
    //         }

    //         if ($request->user()) {
    //             $fields['metadata']['user_id'] = $request->user()->id;
    //         }

    //         $response = Http::withHeaders([
    //             "Authorization" => 'Bearer ' . env('PAYSTACK_SECRET_KEY'),
    //         ])->post("https://api.paystack.co/transaction/initialize", $fields);

    //         $data = $response->json();

    //         if ($response->successful() && $data['status'] === true) {
    //             return redirect()->away($data['data']['authorization_url']);
    //         } else {
    //             $errorMessage = isset($data['message']) ? $data['message'] : 'Error processing payments';
    //             \Log::error('Exception occurred: ' . $errorMessage);
    //             Session::flash('error', 'Error processing payments');
    //             return view('payment-status')->with('error', 'Error processing payments');
    //         }
    //     } catch (\Exception $e) {
    //         \Log::error('Exception occurred: ' . $e->getMessage());
    //         return redirect()->back()->with('error', 'An error occurred while processing the transaction.');
    //     }
    // }

    // public function handlePaymentCallback(Request $request)
    // {
    //     $trxref = $request->query('trxref');
    //     $reference = $request->query('reference');

    //     $response = Http::withHeaders([
    //         "Authorization" => 'Bearer ' . env('PAYSTACK_SECRET_KEY'),
    //     ])->get("https://api.paystack.co/transaction/verify/{$reference}");

    //     $data = $response->json();

    //     $userId = $request->user()->id; 
    //     $paymentFor = $data['data']['metadata']['payment_for'];
    //     $paymentStatus = $data['data']['status'] === 'success' ? 'success' : 'failed';
    //     $amountPaid = $data['data']['amount'] / 100;

    //     Payment::create([
    //         'trxref' => $trxref,
    //         'reference' => $reference,
    //         'user_id' => $userId,
    //         'amount' => $amountPaid,
    //         'payment_for' => $paymentFor,
    //         'status' => $paymentStatus,
    //     ]);

    //     if ($paymentStatus === 'success') {

    //         if ($paymentFor === 'wallet-top-up') {
    //             $wallet = Wallet::where('user_id', $userId)->first();
    //             if ($wallet) {
    //                 $wallet->increment('balance', $amountPaid);
    //             } 
    //         } else if ($paymentFor === 'become-agent') {
    //             $user = User::find($request->user()->id);
    //             $user->role = 'Agent';
    //             $user->save();
    //         }
            
    //         Session::flash('success', 'Payment made successfully');
    //         return view('payment-status')->with('success', 'Payment made successfully');
    //     } else {
    //         Session::flash('error', 'Error processing payments');
    //         return view('payment-status')->with('error', 'Error processing payments');
    //     }
    // }
}


