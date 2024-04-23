<?php

namespace App\Http\Controllers;

use App\Models\NewEnrollmentTransaction;
use Illuminate\Http\Request;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;


class NewEnrollmentController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        
        $transactions = NewEnrollmentTransaction::where('user_id', $user->id)
            ->orderBy('created_at', 'desc')
            ->get();

        return view('new-enrollment', compact('transactions'));
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
                'nin_number' => 'nullable|integer',
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
                'image' => 'required',
                'left_4_fingers' => 'required|array',
                'left_4_fingers.*' => 'required|max:2048',
                'right_4_fingers' => 'required|array',
                'right_4_fingers.*' => 'required|max:2048',
                'thumb_2_fingers' => 'required|array',
                'thumb_2_fingers.*' => 'required|max:2048',
            ]);

            $leftImages = [];
            foreach ($request->left_4_fingers as $image) {
                $leftImages[] = $image->store('left_4_fingers', 'public');
            }

            $rightImages = [];
            foreach ($request->right_4_fingers as $image) {
                $rightImages[] = $image->store('right_4_fingers', 'public');
            }

            $thumbImages = [];
            foreach ($request->thumb_2_fingers as $image) {
                $thumbImages[] = $image->store('thumb_2_fingers', 'public');
            }

            $data['left_4_fingers'] = json_encode($leftImages);
            $data['right_4_fingers'] = json_encode($rightImages);
            $data['thumb_2_fingers'] = json_encode($thumbImages);
            $data['user_id'] = $user->id;

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
        return view('admin.new-enrollment', compact('transaction'));
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
                'response' => 'sometimes'
            ]);

            $new_enrollment->update($data);

            return back()->with('success', 'New Enrollment transaction updated successfully');

        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }
}
