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
        $user = auth()->user();

        if ($user->role === 'Admin') {
            $pukTransactions = PUKTransaction::all()->map(function ($transaction) {
                $transaction->transaction_type = 'PUK Retrieval';
                return $transaction;
            });
        }else{
            $pukTransactions = PUKTransaction::where('user_id', $user->id)->get()->map(function ($transaction) {
                $transaction->transaction_type = 'PUK Retrieval';
                return $transaction;
            });
        }

        if ($user->role === 'Admin') {
            $verificationTransactions = VerificationTransaction::all()->map(function ($transaction) {
                $transaction->transaction_type = 'Verification';
                return $transaction;
            });
        }else{
            $verificationTransactions = VerificationTransaction::where('user_id', $user->id)->get()->map(function ($transaction) {
                $transaction->transaction_type = 'Verification';
                return $transaction;
            });
        }

        if ($user->role === 'Admin') {
            $validationTransactions = ValidationTransaction::all()->map(function ($transaction) {
                $transaction->transaction_type = 'Validation';
                return $transaction;
            });
        }else{
            $validationTransactions = ValidationTransaction::where('user_id', $user->id)->get()->map(function ($transaction) {
                $transaction->transaction_type = 'Validation';
                return $transaction;
            });
        }

        if ($user->role === 'Admin') {
            $ipeTransactions = IPEClearanceTransaction::all()->map(function ($transaction) {
                $transaction->transaction_type = 'IPE Clearance';
                return $transaction;
            });
        }else{
            $ipeTransactions = IPEClearanceTransaction::where('user_id', $user->id)->get()->map(function ($transaction) {
                $transaction->transaction_type = 'IPE Clearance';
                return $transaction;
            });
        }

        if ($user->role === 'Admin') {
            $newEnrollmentTransactions = NewEnrollmentTransaction::all()->map(function ($transaction) {
                $transaction->transaction_type = 'New Enrollment';
                return $transaction;
            });
        }else{
            $newEnrollmentTransactions = NewEnrollmentTransaction::where('user_id', $user->id)->get()->map(function ($transaction) {
                $transaction->transaction_type = 'New Enrollment';
                return $transaction;
            });
        }

        if ($user->role === 'Admin') {
            $personalizationTransactions = PersonalizationTransaction::all()->map(function ($transaction) {
                $transaction->transaction_type = 'Personalization';
                return $transaction;
            });
        }else{
            $personalizationTransactions = PersonalizationTransaction::where('user_id', $user->id)->get()->map(function ($transaction) {
                $transaction->transaction_type = 'Personalization';
                return $transaction;
            });
        }

        if ($user->role === 'Admin') {
            $modificationTransactions = ModificationTransaction::all()->map(function ($transaction) {
                $transaction->transaction_type = 'Modification';
                return $transaction;
            });
        }else{
            $modificationTransactions = ModificationTransaction::where('user_id', $user->id)->get()->map(function ($transaction) {
                $transaction->transaction_type = 'Modification';
                return $transaction;
            });
        }

        if ($user->role === 'Admin') {
            $allTransactions = PUKTransaction::all()
                ->concat($verificationTransactions)
                ->concat($validationTransactions)
                ->concat($modificationTransactions)
                ->concat($personalizationTransactions)
                ->concat($ipeTransactions)
                ->concat($newEnrollmentTransactions);
        } else {
            $allTransactions = $pukTransactions
                ->concat($modificationTransactions)
                ->concat($personalizationTransactions)
                ->concat($ipeTransactions)
                ->concat($newEnrollmentTransactions)
                ->concat($verificationTransactions)
                ->concat($validationTransactions);
        }
        
        $transactions = $allTransactions->sortByDesc('created_at');
    
        return view('tracks', compact('transactions'));
    }
}
