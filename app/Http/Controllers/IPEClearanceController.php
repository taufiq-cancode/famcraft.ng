<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use App\Models\IPEClearanceTransaction;
use Illuminate\Http\Request;

class IPEClearanceController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        $transactions = IPEClearanceTransaction::where('user_id', $user->id)
            ->orderBy('created_at', 'desc')
            ->get();
            
        return view('ipe-clearance', compact('transactions'));
    }

    public function store(Request $request)
    {
        try {
            $user = auth()->user();
    
            $request->validate([
                'ipe_category' => 'required|string|in:in-processing-error,still-in-process,new-enrollment-for-old-tracking-id',
                'tracking_id' => 'required|string|max:15',
            ]);

    
            $transactionId = 'IPE' . rand(100000, 999999);
            while (IPEClearanceTransaction::where('transaction_id', $transactionId)->exists()) {
                $transactionId = 'IPE' . rand(100000, 999999);
            }
    
            $ipe = IPEClearanceTransaction::create([
                'ipe_category' => $request->ipe_category,
                'tracking_id' => $request->tracking_id,
                'user_id' => $user->id,
                'transaction_id' => $transactionId
            ]);
    
            if ($ipe){
                return back()->with('success', 'IPE clearance request submitted successfully.');
            }

        } catch(\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }

    public function view($ipeId)
    {
        $transaction = IPEClearanceTransaction::findOrFail($ipeId);
        return view('admin.view-ipe', compact('transaction'));
    }

    public function update(Request $request, $ipeId)
    {
        try {
            $admin = auth()->user();
            if ($admin->role !== 'Administrator'){
                return back()->with('error', 'Unauthorized access');
            }

            $ipe = IPEClearanceTransaction::findOrFail($ipeId);

            $data = $request->validate([
                'status' => 'sometimes',
                'response' => 'sometimes'
            ]);

            $ipe->update($data);

            return back()->with('success', 'IPE clearance transaction updated successfully');

        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }
}
