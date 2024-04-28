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
        $pukTransactions = PUKTransaction::all()->map(function ($transaction) {
            $transaction->transaction_type = 'PUK Retrieval';
            return $transaction;
        });
    
        $verificationTransactions = VerificationTransaction::all()->map(function ($transaction) {
            $transaction->transaction_type = 'Verification';
            return $transaction;
        });

        $validationTransactions = ValidationTransaction::all()->map(function ($transaction) {
            $transaction->transaction_type = 'Validation';
            return $transaction;
        });

        $ipeTransactions = IPEClearanceTransaction::all()->map(function ($transaction) {
            $transaction->transaction_type = 'IPE Clearance';
            return $transaction;
        });

        $newEnrollmentTransactions = NewEnrollmentTransaction::all()->map(function ($transaction) {
            $transaction->transaction_type = 'New Enrollment';
            return $transaction;
        });

        $personalizationTransactions = PersonalizationTransaction::all()->map(function ($transaction) {
            $transaction->transaction_type = 'Personalization';
            return $transaction;
        });

        $modificationTransactions = ModificationTransaction::all()->map(function ($transaction) {
            $transaction->transaction_type = 'Modification';
            return $transaction;
        });

        $allTransactions = PUKTransaction::all()
            ->concat($pukTransactions)
            ->concat($validationTransactions)
            ->concat($verificationTransactions)
            ->concat($modificationTransactions)
            ->concat($personalizationTransactions)
            ->concat($ipeTransactions)
            ->concat($newEnrollmentTransactions);
    
        $transactions = $allTransactions->sortByDesc('created_at');
    
        return view('tracks', compact('transactions'));
    }
    
}
