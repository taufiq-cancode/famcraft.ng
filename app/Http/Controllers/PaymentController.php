<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use App\Models\User;
use App\Models\Wallet;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;

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

    public function store(Request $request)
    {
        try {
            $user = auth()->user();
    
            $data = $request->validate([
                'payment_type' => 'required|string|in:manual-transfer,online-gateway',
                'payment_for' => 'required|string',
                'amount' => 'required|integer',
                'screenshot' => 'required|image'
            ]);

            if ($request->hasFile('screenshot')) {
                $imagePath = $request->file('screenshot')->store('screenshots', 'public');
                $data['screenshot'] = $imagePath;
            }

            $data['user_id'] = $user->id;
            $data['status'] = 'pending';

            $payment = Payment::create($data);
    
            if ($payment){
                return back()->with('success', 'Payment submitted successfully.');
            }

        } catch(Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }

    public function view($paymentId)
    {
        try {
            $admin = auth()->user();
            if ($admin->role !== 'Administrator'){
                return back()->with('error', 'Unauthorized access');
            }

            $payment = Payment::findOrFail($paymentId);
            
            return view('details.payment', compact('payment'));
        } catch (Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }
    
    public function update(Request $request, $paymentId)
    {
        try {
            $admin = auth()->user();
            if ($admin->role !== 'Administrator'){
                return back()->with('error', 'Unauthorized access');
            }

            $payment = Payment::findOrFail($paymentId);

            $data = $request->validate([
                'status' => 'sometimes',
            ]);
    
            $payment->update($data);

            return back()->with('success', 'Payment status updated successfully');

        } catch (Exception $e) {
            return back()->with('error', $e->getMessage());
        }
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
    //}

    // public function handlePaymentCallback(Request $request)
    // {
    //     $transactionRef = $request->input('transactionref');
    //     $status = $request->input('status');
    //     $amount = $request->input('amount');
    //     $userId = $request->input('userId');
    //     $paymentFor = $request->input('paymentFor');
    //     $paymentType = $request->input('paymentType');

    //     $payload = json_decode($request->getContent(), true);

    //     if (isset($payload['payment_payload']['paymentstatus'])) {

    //         $paymentStatus = $payload['payment_payload']['paymentstatus'];

    //         if ($paymentStatus === 'paid') {

    //             $loginUrl = env('VPAY_LOGIN_BASE_URL') . '/api/service/v1/query/merchant/login';
    //             Log::info('Login URL:', ['url' => $loginUrl]);

    //             $loginResponse = Http::withHeaders([
    //                 'Content-Type' => 'application/json',
    //                 'publicKey' => env('VPAY_PUBLIC_KEY')
    //             ])->post($loginUrl, [
    //                 'username' => env('VPAY_USERNAME'),
    //                 'password' => env('VPAY_PASSWORD'),
    //             ]);

    //             Log::info('Login response status:', ['status_code' => $loginResponse->status()]);

    //             if ($loginResponse->successful()) {
    //                 $responseData = $loginResponse->json();
    //                 Log::info('Login response data:', ['data' => $responseData]);

    //                 if ($responseData['token']) {
    //                     $accessToken = $responseData['token'];

    //                     $queryUrl = env('VPAY_BASE_URL') . '/api/v1/webintegration/query-transaction';
    //                     Log::info('Query URL:', ['url' => $queryUrl]);
    //                     Log::info('Query Payload:', ['transactionRef' => $transactionRef]);

    //                     $queryResponse = Http::withHeaders([
    //                         'Content-Type' => 'application/json',
    //                         'publicKey' => env('VPAY_PUBLIC_KEY'),
    //                         'b-access-token' => $accessToken
    //                     ])->get($queryUrl, [
    //                         'transactionRef' => $transactionRef,
    //                     ]);

    //                     Log::info('Query response status:', ['status_code' => $queryResponse->status()]);

    //                     // Check if the response is JSON
    //                     $queryResponseBody = $queryResponse->body();
    //                     Log::info('Query response body:', ['body' => $queryResponseBody]);

    //                     if ($queryResponse->successful() && $this->isJson($queryResponseBody)) {
    //                         $queryResponseData = $queryResponse->json();

    //                         if (isset($queryResponseData['data']) && $queryResponseData['data']['paymentstatus'] === 'paid') {
    //                             Log::info('Transaction paid');

    //                             Payment::create([
    //                                 'trxref' => $transactionRef,
    //                                 'user_id' => $userId,
    //                                 'amount' => $amount,
    //                                 'payment_for' => $paymentFor,
    //                                 'payment_type' => $paymentType,
    //                                 'status' => $status,
    //                             ]);

    //                             if ($paymentFor === 'wallet-top-up') {
    //                                 $wallet = Wallet::where('user_id', $userId)->first();
    //                                 if ($wallet) {
    //                                     $wallet->increment('balance', $amount);
    //                                 }
    //                             } else if ($paymentFor === 'become-agent') {
    //                                 $user = User::find($request->user()->id);
    //                                 $user->role = 'Agent';
    //                                 $user->save();
    //                             }

    //                             Session::flash('success', 'Payment made successfully');
    //                             return view('payment-status')->with('success', 'Payment made successfully');
    //                         } else {
    //                             Log::error('Transaction not paid or data missing');
    //                             Session::flash('error', 'Error processing payments');
    //                             return view('payment-status')->with('error', 'Error processing payments');
    //                         }
    //                     } else {
    //                         Log::error('Error processing payments - Query failed');
    //                         Session::flash('error', 'Error processing payments');
    //                         return view('payment-status')->with('error', 'Error processing payments');
    //                     }
    //                 } else {
    //                     Log::error('Login response does not contain token');
    //                     Session::flash('error', 'Error processing payments');
    //                     return view('payment-status')->with('error', 'Error processing payments');
    //                 }
    //             } else {
    //                 Log::error('Login failed');
    //                 Log::error('Login response body:', ['body' => $loginResponse->body()]);
    //                 Session::flash('error', 'Error processing payments');
    //                 return view('payment-status')->with('error', 'Error processing payments');
    //             }
    //         } else {
    //             Log::error('Payment status not paid');
    //             Session::flash('error', 'Error processing payments');
    //             return view('payment-status')->with('error', 'Error processing payments');
    //         }
    //     }
    // }
    // private function isJson($string) {
    //     json_decode($string);
    //     return (json_last_error() == JSON_ERROR_NONE);
    // }

    public function handlePaymentCallback(Request $request)
    {
        // Log the incoming request for debugging
        Log::info('Webhook received:', $request->all());

        // Validate the request
        $validator = Validator::make($request->all(), [
            'reference' => 'required|string',
            'amount' => 'required|integer',
            'account_number' => 'required|string',
            'originator_account_name' => 'required|string',
            'timestamp' => 'required|date',
        ]);

        if ($validator->fails()) {
            Log::error('Validation failed:', $validator->errors()->all());
            return response()->json(['error' => 'Invalid payload'], 400);
        }

        // Verify the JWT token
        $jwtToken = $request->header('x-payload-auth');
        if (!$this->verifyJwtToken($jwtToken)) {
            Log::error('JWT token verification failed');
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        // Process the transaction
        // Your transaction processing logic here

        Log::info('Transaction processed successfully');

        // Respond with a 200 status code
        return response()->json(['message' => 'Transaction processed'], 200);
    }

    private function verifyJwtToken($jwtToken)
    {
        if (!$jwtToken) {
            return false;
        }

        try {
            $secretKey = env('WEBHOOK_SECRET_KEY');
            $decoded = JWT::decode($jwtToken, new Key($secretKey, 'HS256'));
            return isset($decoded->secret) && $decoded->secret === $secretKey;
        } catch (\Exception $e) {
            Log::error('JWT verification error:', ['error' => $e->getMessage()]);
            return false;
        }
    }
}