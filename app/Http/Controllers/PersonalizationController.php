<?php

namespace App\Http\Controllers;

use App\Models\PersonalizationTransaction;
use App\Models\Pricing;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

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
            DB::beginTransaction();

            $user = auth()->user();
    
            $request->validate([
                'tracking_id' => 'required|string|max:15',
            ]);

            $serviceFee = 0;

            $service = Pricing::where('item_name', 'per-personalization-request')->first();
            $serviceFee = $service->price ?? null;

            if ($user->wallet->balance < $serviceFee) {
                DB::rollBack();
                return back()->with('error', 'Insufficient balance');
            }

            $user->wallet->balance -= $serviceFee;
            $user->wallet->save();
    
            $transactionId = 'PER' . rand(100000, 999999);
            while (PersonalizationTransaction::where('transaction_id', $transactionId)->exists()) {
                $transactionId = 'PER' . rand(100000, 999999);
            }

            $personalization = PersonalizationTransaction::create([
                'tracking_id' => $request->tracking_id,
                'user_id' => $user->id,
                'transaction_id' => $transactionId,
                'price' => $serviceFee
            ]);

            if ($personalization){
                DB::commit();
                return back()->with('success', 'Personalization request submitted successfully.');
            }

        } catch(\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }

    public function view($personalizationId)
    {
        $transaction = PersonalizationTransaction::findOrFail($personalizationId);
        return view('details.personalization', compact('transaction'));
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
                $data['response_pdf'] = array_merge((array) $personalization->response_pdf, $filePaths);
            }
            $personalization->update($data);

            return back()->with('success', 'Personalization transaction updated successfully');

        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }
}
