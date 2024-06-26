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
            ->paginate(10);

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
                'modification_type' => 'required|string|in:name,dob,name_dob,name_others,dob_others,suspended_bvn,new_enrollment_old_slip,others',
                'nin' => 'nullable|integer',
                'nin_2' => 'nullable|integer',
                'old_nin' => 'nullable|integer',
                'tracking_id' => 'nullable|string',
                'details_to_modify' => 'nullable|array',
                'details_to_modify.*' => 'nullable',
                'title' => 'nullable|string',
                'title_2' => 'nullable|string',
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
                'surname_4' => 'nullable|string|max:255',
                'firstname_4' => 'nullable|string|max:255',
                'middlename_4' => 'nullable|string|max:255',
                'surname_5' => 'nullable|string|max:255',
                'firstname_5' => 'nullable|string|max:255',
                'middlename_5' => 'nullable|string|max:255',
                'dob_4' => 'nullable|date',
                'dob_5' => 'nullable|date',
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
                'lga_of_origin' => 'nullable|string',
                'phone' => 'nullable|string',
                'religion' => 'nullable|string',
                'gender_2' => 'nullable|string|in:male,female',
                'town_2' => 'nullable|string',
                'country_of_residence_2' => 'nullable|string',
                'state_of_residence_2' => 'nullable|string',
                'lga_of_residence_2' => 'nullable|string',
                'address_line_1_2' => 'nullable|string',
                'address_line_2_2' => 'nullable|string',
                'profession_2' => 'nullable|string',
                'passport_2' => 'nullable|image',
                'state_of_origin_2' => 'nullable|string',
                'lga_of_origin_2' => 'nullable|string',
                'phone_2' => 'nullable|string',
                'religion_2' => 'nullable|string',
                'gender_3' => 'nullable|string|in:male,female',
                'town_3' => 'nullable|string',
                'country_of_residence_3' => 'nullable|string',
                'state_of_residence_3' => 'nullable|string',
                'lga_of_residence_3' => 'nullable|string',
                'address_line_1_3' => 'nullable|string',
                'address_line_2_3' => 'nullable|string',
                'profession_3' => 'nullable|string',
                'passport_3' => 'nullable|image',
                'state_of_origin_3' => 'nullable|string',
                'lga_of_origin_3' => 'nullable|string',
                'phone_3' => 'nullable|string',
                'religion_3' => 'nullable|string',
                'gender_4' => 'nullable|string|in:male,female',
                'town_4' => 'nullable|string',
                'country_of_residence_4' => 'nullable|string',
                'state_of_residence_4' => 'nullable|string',
                'lga_of_residence_4' => 'nullable|string',
                'address_line_1_4' => 'nullable|string',
                'address_line_2_4' => 'nullable|string',
                'profession_4' => 'nullable|string',
                'passport_4' => 'nullable|image',
                'state_of_origin_4' => 'nullable|string',
                'lga_of_origin_4' => 'nullable|string',
                'phone_4' => 'nullable|string',
                'religion_4' => 'nullable|string',
                'gender_7' => 'nullable|string|in:male,female',
                'town_7' => 'nullable|string',
                'country_of_residence_7' => 'nullable|string',
                'state_of_residence_7' => 'nullable|string',
                'lga_of_residence_7' => 'nullable|string',
                'address_line_1_7' => 'nullable|string',
                'address_line_2_7' => 'nullable|string',
                'profession_7' => 'nullable|string',
                'passport_7' => 'nullable|image',
                'state_of_origin_7' => 'nullable|string',
                'lga_of_origin_7' => 'nullable|string',
                'phone_7' => 'nullable|string',
                'religion_7' => 'nullable|string',
            ]);

            if ($request->filled('nin_2')) {
                $data['nin'] = $request->input('nin_2');
            }

            if ($request->filled('firstname_2')) {
                $data['firstname'] = $request->input('firstname_2');
            }else if ($request->filled('firstname_3')) {
                $data['firstname'] = $request->input('firstname_3');
            }else if ($request->filled('firstname_4')) {
                $data['firstname'] = $request->input('firstname_4');
            }else if ($request->filled('firstname_5')) {
                $data['firstname'] = $request->input('firstname_5');
            }else if ($request->filled('firstname_6')) {
                $data['firstname'] = $request->input('firstname_6');
            }else if ($request->filled('firstname_7')) {
                $data['firstname'] = $request->input('firstname_7');
            }

            if ($request->filled('surname_2')) {
                $data['surname'] = $request->input('surname_2');
            }else if ($request->filled('surname_3')) {
                $data['surname'] = $request->input('surname_3');
            }else if ($request->filled('surname_4')) {
                $data['surname'] = $request->input('surname_4');
            }else if ($request->filled('surname_5')) {
                $data['surname'] = $request->input('surname_5');
            }else if ($request->filled('surname_6')) {
                $data['surname'] = $request->input('surname_6');
            }else if ($request->filled('surname_7')) {
                $data['surname'] = $request->input('surname_7');
            }

            if ($request->filled('middlename_2')) {
                $data['middlename'] = $request->input('middlename_2');
            }else if ($request->filled('middlename_3')) {
                $data['middlename'] = $request->input('middlename_3');
            }else if ($request->filled('middlename_4')) {
                $data['middlename'] = $request->input('middlename_4');
            }else if ($request->filled('middlename_5')) {
                $data['middlename'] = $request->input('middlename_5');
            }else if ($request->filled('middlename_6')) {
                $data['middlename'] = $request->input('middlename_6');
            }else if ($request->filled('middlename_7')) {
                $data['middlename'] = $request->input('middlename_7');
            }

            if ($request->filled('dob_2')) {
                $data['dob'] = $request->input('dob_2');
            }else if ($request->filled('dob_3')) {
                $data['dob'] = $request->input('dob_3');
            }else if ($request->filled('dob_4')) {
                $data['dob'] = $request->input('dob_4');
            }else if ($request->filled('dob_5')) {
                $data['dob'] = $request->input('dob_5');
            }else if ($request->filled('dob_6')) {
                $data['dob'] = $request->input('dob_6');
            }else if ($request->filled('dob_7')) {
                $data['dob'] = $request->input('dob_7');
            }

            if ($request->filled('gender_2')) {
                $data['gender'] = $request->input('gender_2');
            }else if ($request->filled('gender_3')) {
                $data['gender'] = $request->input('gender_3');
            }else if ($request->filled('gender_4')) {
                $data['gender'] = $request->input('gender_4');
            }else if ($request->filled('gender_5')) {
                $data['gender'] = $request->input('gender_5');
            }else if ($request->filled('gender_7')) {
                $data['gender'] = $request->input('gender_7');
            }

            if ($request->filled('title_2')) {
                $data['title'] = $request->input('title_2');
            }else if ($request->filled('title_3')) {
                $data['title'] = $request->input('title_3');
            }else if ($request->filled('title_4')) {
                $data['title'] = $request->input('title_4');
            }else if ($request->filled('title_5')) {
                $data['title'] = $request->input('title_5');
            }else if ($request->filled('title_7')) {
                $data['title'] = $request->input('title_7');
            }

            if ($request->filled('phone_2')) {
                $data['phone'] = $request->input('phone_2');
            }else if ($request->filled('phone_3')) {
                $data['phone'] = $request->input('phone_3');
            }else if ($request->filled('phone_4')) {
                $data['phone'] = $request->input('phone_4');
            }else if ($request->filled('phone_5')) {
                $data['phone'] = $request->input('phone_5');
            }else if ($request->filled('phone_7')) {
                $data['phone'] = $request->input('phone_7');
            }

            if ($request->filled('state_of_residence_2')) {
                $data['state_of_residence'] = $request->input('state_of_residence_2');
            }else if ($request->filled('state_of_residence_3')) {
                $data['state_of_residence'] = $request->input('state_of_residence_3');
            }else if ($request->filled('state_of_residence_4')) {
                $data['state_of_residence'] = $request->input('state_of_residence_4');
            }else if ($request->filled('state_of_residence_5')) {
                $data['state_of_residence'] = $request->input('state_of_residence_5');
            }else if ($request->filled('state_of_residence_7')) {
                $data['state_of_residence'] = $request->input('state_of_residence_7');
            }

            if ($request->filled('lga_of_residence_2')) {
                $data['lga_of_residence'] = $request->input('lga_of_residence_2');
            }else if ($request->filled('lga_of_residence_3')) {
                $data['lga_of_residence'] = $request->input('lga_of_residence_3');
            }else if ($request->filled('lga_of_residence_4')) {
                $data['lga_of_residence'] = $request->input('lga_of_residence_4');
            }else if ($request->filled('lga_of_residence_5')) {
                $data['lga_of_residence'] = $request->input('lga_of_residence_5');
            }else if ($request->filled('lga_of_residence_7')) {
                $data['lga_of_residence'] = $request->input('lga_of_residence_7');
            }

            if ($request->filled('town_2')) {
                $data['town'] = $request->input('town_2');
            }else if ($request->filled('town_3')) {
                $data['town'] = $request->input('town_3');
            }else if ($request->filled('town_4')) {
                $data['town'] = $request->input('town_4');
            }else if ($request->filled('town_5')) {
                $data['town'] = $request->input('town_5');
            }else if ($request->filled('town_7')) {
                $data['town'] = $request->input('town_7');
            }

            if ($request->filled('address_line_1_2')) {
                $data['address_line_1'] = $request->input('address_line_1_2');
            }else if ($request->filled('address_line_1_3')) {
                $data['address_line_1'] = $request->input('address_line_1_3');
            }else if ($request->filled('address_line_1_4')) {
                $data['address_line_1'] = $request->input('address_line_1_4');
            }else if ($request->filled('address_line_1_5')) {
                $data['address_line_1'] = $request->input('address_line_1_5');
            }else if ($request->filled('address_line_1_7')) {
                $data['address_line_1'] = $request->input('address_line_1_7');
            }

            if ($request->filled('address_line_2_2')) {
                $data['address_line_2'] = $request->input('address_line_2_2');
            }else if ($request->filled('address_line_2_3')) {
                $data['address_line_2'] = $request->input('address_line_2_3');
            }else if ($request->filled('address_line_2_4')) {
                $data['address_line_2'] = $request->input('address_line_2_4');
            }else if ($request->filled('address_line_2_5')) {
                $data['address_line_2'] = $request->input('address_line_2_5');
            }else if ($request->filled('address_line_2_7')) {
                $data['address_line_2'] = $request->input('address_line_2_7');
            }

            if ($request->filled('religion_2')) {
                $data['religion'] = $request->input('religion_2');
            }else if ($request->filled('religion_3')) {
                $data['religion'] = $request->input('religion_3');
            }else if ($request->filled('religion_4')) {
                $data['religion'] = $request->input('religion_4');
            }else if ($request->filled('religion_5')) {
                $data['religion'] = $request->input('religion_5');
            }else if ($request->filled('religion_7')) {
                $data['religion'] = $request->input('religion_7');
            }

            if ($request->filled('profession_2')) {
                $data['profession'] = $request->input('profession_2');
            }else if ($request->filled('profession_3')) {
                $data['profession'] = $request->input('profession_3');
            }else if ($request->filled('profession_4')) {
                $data['profession'] = $request->input('profession_4');
            }else if ($request->filled('profession_5')) {
                $data['profession'] = $request->input('profession_5');
            }else if ($request->filled('profession_7')) {
                $data['profession'] = $request->input('profession_7');
            }

            if ($request->filled('state_of_origin_2')) {
                $data['state_of_origin'] = $request->input('state_of_origin_2');
            }else if ($request->filled('state_of_origin_3')) {
                $data['state_of_origin'] = $request->input('state_of_origin_3');
            }else if ($request->filled('state_of_origin_4')) {
                $data['state_of_origin'] = $request->input('state_of_origin_4');
            }else if ($request->filled('state_of_origin_5')) {
                $data['state_of_origin'] = $request->input('state_of_origin_5');
            }else if ($request->filled('state_of_origin_7')) {
                $data['state_of_origin'] = $request->input('state_of_origin_7');
            }

            if ($request->filled('lga_of_origin_2')) {
                $data['lga_of_origin'] = $request->input('lga_of_origin_2');
            }else if ($request->filled('lga_of_origin_3')) {
                $data['lga_of_origin'] = $request->input('lga_of_origin_3');
            }else if ($request->filled('lga_of_origin_4')) {
                $data['lga_of_origin'] = $request->input('lga_of_origin_4');
            }else if ($request->filled('lga_of_origin_5')) {
                $data['lga_of_origin'] = $request->input('lga_of_origin_5');
            }else if ($request->filled('lga_of_origin_7')) {
                $data['lga_of_origin'] = $request->input('lga_of_origin_7');
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
            }else if ($request->hasFile('passport_2')) {
                $imagePath = $request->file('passport_2')->store('passports', 'public');
                $data['passport'] = $imagePath;
            }else if ($request->hasFile('passport_3')) {
                $imagePath = $request->file('passport_3')->store('passports', 'public');
                $data['passport'] = $imagePath;
            }else if ($request->hasFile('passport_4')) {
                $imagePath = $request->file('passport_4')->store('passports', 'public');
                $data['passport'] = $imagePath;
            }else if ($request->hasFile('passport_7')) {
                $imagePath = $request->file('passport_7')->store('passports', 'public');
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

            } elseif ($modificationType === 'name_others') {
                $fee = Pricing::where('item_name', 'name-others-modification')->first();

            } elseif ($modificationType === 'dob_others') {
                $fee = Pricing::where('item_name', 'dob-others-modification')->first();
            
            } elseif ($modificationType === 'suspended_bvn') {
                $fee = Pricing::where('item_name', 'suspended-bvn-modification')->first();

            } elseif ($modificationType === 'new_enrollment_old_slip') {
                $fee = Pricing::where('item_name', 'new-enrollment-old-slip-modification')->first();
    
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
                    $path = $file->store('response_pdfs', 'public');
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
