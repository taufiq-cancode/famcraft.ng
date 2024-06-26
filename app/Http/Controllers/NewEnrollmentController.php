<?php

namespace App\Http\Controllers;

use App\Models\NewEnrollmentTransaction;
use App\Models\Pricing;
use Illuminate\Http\Request;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;



class NewEnrollmentController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        
        $transactions = NewEnrollmentTransaction::where('user_id', $user->id)
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        $countries_states = storage_path('app/json/countries.json'); 
        $countries_states_data = json_decode(file_get_contents($countries_states), true);
        $countries = $countries_states_data;

        $states_lgas = storage_path('app/json/states.json'); 
        $states_lgas_data = json_decode(file_get_contents($states_lgas), true);
        $states = $states_lgas_data;

        return view('new-enrollment', compact('transactions', 'countries', 'states'));
    }

    public function store(Request $request)
    {
        try {
            $user = auth()->user();
    
            $data = $request->validate([
                'type' => 'required|string|in:adult,child',
                'surname' => 'required|string|max:255',
                'firstname' => 'required|string|max:255',
                'middlename' => 'required|string|max:255',
                'gender' => 'required|string|in:male,female',
                'dob' => 'required|date',
                'country_of_birth' => 'required|string',
                'nationality' => 'required|string',
                'nin' => 'nullable|integer',
                'town' => 'required|string',
                'country_of_residence' => 'required|string',
                'state_of_residence' => 'required|string',
                'lga_of_residence' => 'required|string',
                'address_line_1' => 'required|string',
                'address_line_2' => 'nullable|string',
                'zipcode' => 'nullable|string',
                'country_of_origin' => 'nullable|string',
                'state_of_origin' => 'nullable|string',
                'phone' => 'required|string',
                'email' => 'required|string',
                'height' => 'required|integer',
                'parent_surname' => 'required_if:type,child|max:255',
                'parent_firstname' => 'required_if:type,child|max:255',
                'parent_nin' => 'required_if:type,child|max:255',
                'image' => 'required|image',
                'left_finger' => 'required|image',
                'thumb_finger' => 'required|image',
                'right_finger' => 'required|image',
            ]);

            if ($request->hasFile('image')) {
                $imagePath = $request->file('image')->store('images', 'public');
                $data['image'] = $imagePath;
            }

            if ($request->hasFile('left_finger')) {
                $imagePath = $request->file('left_finger')->store('left_fingers', 'public');
                $data['left_finger'] = $imagePath;
            }

            if ($request->hasFile('thumb_finger')) {
                $imagePath = $request->file('thumb_finger')->store('thumb_fingers', 'public');
                $data['thumb_finger'] = $imagePath;
            }

            if ($request->hasFile('right_finger')) {
                $imagePath = $request->file('right_finger')->store('right_fingers', 'public');
                $data['right_finger'] = $imagePath;
            }

            $data['user_id'] = $user->id;

            $serviceFee = 0;
            $enrollmentType = $request->type;

            if ($enrollmentType === 'adult') {
                $fee = Pricing::where('item_name', 'adult-enrollment')->first();
            } elseif ($enrollmentType === 'child') {
                $fee = Pricing::where('item_name', 'child-enrollment')->first();
            }

            $serviceFee = $fee->price ?? null;

            if ($user->wallet->balance < $serviceFee) {
                DB::rollBack();
                return back()->with('error', 'Insufficient balance.');
            }
            $user->wallet->balance -= $serviceFee;
            $user->wallet->save();

            $transactionId = 'NEN' . rand(100000, 999999);
            while (NewEnrollmentTransaction::where('transaction_id', $transactionId)->exists()) {
                $transactionId = 'NEN' . rand(100000, 999999);
            }

            $data['transaction_id'] = $transactionId;
            $data['price'] = $serviceFee;

            $new_enrollment = NewEnrollmentTransaction::create($data);
    
            if ($new_enrollment){
                return back()->with('success', 'New Enrollment request submitted successfully.');
            }

        } catch(ValidationException $e) {
            Log::error($e->getMessage());
            return back()->with('error', $e->getMessage());
        }
    }

    public function view($newEnrollmentId)
    {
        $transaction = NewEnrollmentTransaction::findOrFail($newEnrollmentId);
        return view('details.new-enrollment', compact('transaction'));
    }

    public function update(Request $request, $newEnrollmentId)
    {
        try {
            $admin = auth()->user();
            if ($admin->role !== 'Administrator'){
                return back()->with('error', 'Unauthorized access');
            }

            $new_enrollment = NewEnrollmentTransaction::findOrFail($newEnrollmentId);

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
                $data['response_pdf'] = array_merge((array) $new_enrollment->response_pdf, $filePaths);
            }
            $new_enrollment->update($data);

            return back()->with('success', 'New Enrollment transaction updated successfully');

        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }
}
