<?php

namespace App\Http\Controllers;

use App\Models\IPEClearanceTransaction;
use App\Models\ModificationTransaction;
use App\Models\NewEnrollmentTransaction;
use App\Models\PersonalizationTransaction;
use App\Models\PUKTransaction;
use App\Models\ValidationTransaction;
use App\Models\VerificationTransaction;
use Illuminate\Http\Request;

class TracksController extends Controller
{
    public function index()
    {
        $PUK = PUKTransaction::all();
        $verification = VerificationTransaction::all();
        $validation = ValidationTransaction::all();
        $modification = ModificationTransaction::all();
        $personalization = PersonalizationTransaction::all();
        $ipeClearance = IPEClearanceTransaction::all();
        $newEnrollment = NewEnrollmentTransaction::all();
        
        $allTransactions = $PUK->merge($verification)
            ->merge($validation)
            ->merge($modification)
            ->merge($personalization)
            ->merge($ipeClearance)
            ->merge($newEnrollment);

        $transactions = $allTransactions->sortByDesc('created_at');

        return view('tracks', compact('transactions'));
    }
}
