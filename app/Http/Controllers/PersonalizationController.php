<?php

namespace App\Http\Controllers;

use App\Models\PersonalizationTransaction;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PersonalizationController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        $transactions = PersonalizationTransaction::where('user_id', $user->id)
            ->orderBy('created_at', 'desc')
            ->get();

        return view('personalization', compact('transactions'));
    }

    public function store(Request $request)
    {
        try {
            $user = auth()->user();
    
            $request->validate([
                'tracking_id' => 'required|string|max:15',
            ]);
    
            $transactionId = 'PER' . rand(100000, 999999);
            while (PersonalizationTransaction::where('transaction_id', $transactionId)->exists()) {
                $transactionId = 'PER' . rand(100000, 999999);
            }

            $personalization = PersonalizationTransaction::create([
                'tracking_id' => $request->tracking_id,
                'user_id' => $user->id,
                'transaction_id' => $transactionId
            ]);

            if ($personalization){
                return back()->with('success', 'Personalization request submitted successfully.');
            }

        } catch(\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }

    public function view($personalizationId)
    {
        $transaction = PersonalizationTransaction::findOrFail($personalizationId);
        return view('admin.view-personalization', compact('transaction'));
    }

    public function update(Request $request, $personalizationId)
    {
        try {
            $admin = auth()->user();
            if ($admin->role !== 'Administrator'){
                return back()->with('error', 'Unauthorized access');
            }

            $personalization = PersonalizationTransaction::findOrFail($personalizationId);

            $data = $request->validate([
                'status' => 'sometimes',
                'response' => 'sometimes'
            ]);

            $personalization->update($data);

            return back()->with('success', 'Personalization transaction updated successfully');

        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }
}
