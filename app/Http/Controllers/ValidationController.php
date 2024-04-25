<?php

namespace App\Http\Controllers;

use App\Models\ValidationTransaction;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ValidationController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $transactions = ValidationTransaction::where('user_id', $user->id)->get();
        return view('validation', compact('transactions'));
    }

    public function store(Request $request)
    {
        try {
            $user = auth()->user();
    
            $request->validate([
                'nin' => 'required|max:15',
                'validation_category' => 'required|string|in:no-record-found,update-record,validation-modification,v-nin-validation,photograph-error,by-pass-nin',
                'validation_purpose' => 'required|string|in:bank,sim,passport,others',
            ]);

            $transactionId = 'VAL' . rand(100000, 999999);
            while (ValidationTransaction::where('transaction_id', $transactionId)->exists()) {
                $transactionId = 'VAL' . rand(100000, 999999);
            }
            
            $validation = ValidationTransaction::create([
                'nin' => $request->nin,
                'validation_category' => $request->validation_category,
                'validation_purpose' => $request->validation_purpose,
                'user_id' => $user->id,
                'transaction_id' => $transactionId
            ]);
    
            if ($validation){
                return back()->with('success', 'Validation request submitted successfully.');
            }

        } catch(\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }

    public function view($validationId)
    {
        $transaction = ValidationTransaction::findOrFail($validationId);
        return view('admin.view-validation', compact('transaction'));
    }

    public function update(Request $request, $validationId)
    {
        try {
            $admin = auth()->user();
            if ($admin->role !== 'Administrator'){
                return back()->with('error', 'Unauthorized access');
            }

            $validation = ValidationTransaction::findOrFail($validationId);

            $data = $request->validate([
                'status' => 'sometimes',
                'response' => 'sometimes'
            ]);

            $validation->update($data);

            return back()->with('success', 'Validation transaction updated successfully');

        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }
}
