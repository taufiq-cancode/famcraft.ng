<?php

namespace App\Http\Controllers;

use App\Models\ModificationTransaction;
use App\Models\Pricing;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;


class ModificationController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        $transactions = ModificationTransaction::where('user_id', $user->id)
            ->orderBy('created_at', 'desc')
            ->get();

        $states_lgas = storage_path('app/json/states.json'); 
        $states_lgas_data = json_decode(file_get_contents($states_lgas), true);
        $states = $states_lgas_data;
            
        return view('modification', compact('transactions', 'states'));
    }

    public function store(Request $request)
    {
        try {
            $user = auth()->user();
    
            $data = $request->validate([
                'modification_type' => 'required|string|in:name,dob,name_dob,others',
                'nin' => 'required|integer',
                'tracking_id' => 'required|string',
                'details_to_modify' => 'nullable|array',
                'details_to_modify.*' => 'nullable',
                'title' => 'nullable|string',
                'surname' => 'nullable|string|max:255',
                'firstname' => 'nullable|string|max:255',
                'middlename' => 'nullable|string|max:255',
                'dob' => 'nullable|date',
                'surname_2' => 'nullable|string|max:255',
                'firstname_2' => 'nullable|string|max:255',
                'middlename_2' => 'nullable|string|max:255',
                'dob_2' => 'nullable|date',
                'surname_3' => 'nullable|string|max:255',
                'firstname_3' => 'nullable|string|max:255',
                'middlename_3' => 'nullable|string|max:255',
                'dob_3' => 'nullable|date',
                'gender' => 'nullable|string|in:male,female',
                'town' => 'nullable|string',
                'country_of_residence' => 'nullable|string',
                'state_of_residence' => 'nullable|string',
                'lga_of_residence' => 'nullable|string',
                'address_line_1' => 'nullable|string',
                'address_line_2' => 'nullable|string',
                'profession' => 'nullable|string',
                'passport' => 'nullable|image',
                'state_of_origin' => 'nullable|string',
                'phone' => 'nullable|string',
                'religion' => 'nullable|string',
            ]);

            if ($request->filled('firstname_2')) {
                $data['firstname'] = $request->input('firstname_2');
            }else if ($request->filled('firstname_3')) {
                $data['firstname'] = $request->input('firstname_3');
            }

            if ($request->filled('surname_2')) {
                $data['surname'] = $request->input('surname_2');
            }else if ($request->filled('surname_3')) {
                $data['surname'] = $request->input('surname_3');
            }

            if ($request->filled('middlename_2')) {
                $data['middlename'] = $request->input('middlename_2');
            }else if ($request->filled('middlename_3')) {
                $data['middlename'] = $request->input('middlename_3');
            }

            if ($request->filled('dob_2')) {
                $data['dob'] = $request->input('dob_2');
            }else if ($request->filled('dob_3')) {
                $data['dob'] = $request->input('dob_3');
            }

            $details_to_modify = [];
            if ($request->has('details_to_modify') && is_array($request->details_to_modify)) {
                foreach ($request->details_to_modify as $detail_to_modify) {
                    $details_to_modify[] = $detail_to_modify;
                }
            }

            if ($request->hasFile('passport')) {
                $imagePath = $request->file('passport')->store('passports', 'public');
                $data['passport'] = $imagePath;
            }

            $data['details_to_modify'] = json_encode($details_to_modify);
            $data['user_id'] = $user->id;

            $serviceFee = 0;
            $modificationType = $request->modification_type;

            if ($modificationType === 'name') {
                $fee = Pricing::where('item_name', 'name-modification')->first();
            } elseif ($modificationType === 'dob') {
                $fee = Pricing::where('item_name', 'date-of-birth-modification')->first();
            } elseif ($modificationType === 'name_dob') {
                $fee = Pricing::where('item_name', 'name-date-of-birth-modification')->first();
            } elseif ($modificationType === 'dob-other-modification') {
                $fee = Pricing::where('item_name', 'dob-other-modification')->first();
            } elseif ($modificationType === 'others') {
                $fee = Pricing::where('item_name', 'other-modification')->first();
            }

            $serviceFee = $fee->price ?? null;

            if ($user->wallet->balance < $serviceFee) {
                DB::rollBack();
                return back()->with('error', 'Insufficient balance.');
            }
            $user->wallet->balance -= $serviceFee;
            $user->wallet->save();

            $transactionId = 'MOD' . rand(100000, 999999);
            while (ModificationTransaction::where('transaction_id', $transactionId)->exists()) {
                $transactionId = 'MOD' . rand(100000, 999999);
            }

            $data['transaction_id'] = $transactionId;
            $data['price'] = $serviceFee;

            $modification = ModificationTransaction::create($data);
    
            if ($modification){
                return back()->with('success', 'Modification request submitted successfully.');
            }

        } catch(ValidationException $e) {
            Log::error($e->getMessage());
            return back()->with('error', $e->getMessage());
        }
    }

    public function view($modificationId)
    {
        $transaction = ModificationTransaction::findOrFail($modificationId);
        return view('details.modification', compact('transaction'));
    }

    public function update(Request $request, $modificationId)
    {
        try {
            $admin = auth()->user();
            if ($admin->role !== 'Administrator'){
                return back()->with('error', 'Unauthorized access');
            }

            $modification = ModificationTransaction::findOrFail($modificationId);

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
                $data['response_pdf'] = array_merge((array) $modification->response_pdf, $filePaths);
            }

            $modification->update($data);

            return back()->with('success', 'Modification transaction updated successfully');

        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }
}
