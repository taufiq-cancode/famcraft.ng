<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use App\Models\User;
use App\Models\Wallet;
use App\Models\Withdrawal;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
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
            ->paginate(10);

        $withdrawals = Withdrawal::where('user_id', $user->id)
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('wallet', compact('transactions', 'withdrawals'));
    }

    public function store(Request $request)
    {
        try {
            $user = auth()->user();
        
            $data = $request->validate([
                'payment_type' => 'required|string|in:manual-transfer,online-gateway',
                'payment_for' => 'required|string',
                'amount' => 'required|integer',
                'screenshot' => 'nullable|image',
                'trxref' => 'required|string',
                'reference' => 'required|string',
                'user_id' => 'required|integer',
                'status' => 'required|string'
            ]);
    
            if ($request->hasFile('screenshot')) {
                $imagePath = $request->file('screenshot')->store('screenshots', 'public');
                $data['screenshot'] = $imagePath;
            }
    
            $data['user_id'] = $user->id;
            $data['status'] = 'pending';
    
            $payment = Payment::create($data);
        
            if ($payment) {
                return response()->json(['success' => true]);
            } else {
                return response()->json(['success' => false]);
            }
        } catch (Exception $e) {
            return response()->json(['success' => false, 'error' => $e->getMessage()]);
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

    public function handlePaymentCallback(Request $request)
    {
        DB::beginTransaction();

        try {
            $payment = Payment::create($request->all());

            if ($request->payment_for === 'become-agent') {
                $user = User::find($request->user_id);
                if ($user) {
                    $user->role = 'Agent'; // Adjust this to your actual role field and value
                    $user->save();
                }
            } elseif ($request->payment_for === 'wallet-top-up') {
                $wallet = Wallet::firstOrCreate(['user_id' => $request->user_id]);
                $wallet->balance += $request->amount;
                $wallet->save();
            }

            DB::commit();

            return response()->json([
                'success' => true,
                'data' => $payment
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function showPaymentStatus(Request $request)
    {
        $status = $request->query('status', 'error');
        return view('payment-success', compact('status'));
    }
}