<?php

namespace App\Http\Controllers;

use App\Models\IPEClearanceTransaction;
use App\Models\ModificationTransaction;
use App\Models\NewEnrollmentTransaction;
use App\Models\PersonalizationTransaction;
use App\Models\PUKTransaction;
use App\Models\ValidationTransaction;
use App\Models\VerificationTransaction;
use App\Models\Withdrawal;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard()
    {
        $admin = auth()->user();
        if ($admin->role !== 'Administrator'){
            return back()->with('error', 'Unauthorized access');
        }

         // Retrieve and count PUK transactions
        $pukTransactions = PUKTransaction::all();
        $pukTotalCount = $pukTransactions->count();
        $pukPendingCount = $pukTransactions->where('status', 'pending')->count();

        // Retrieve and count verification transactions
        $verificationTransactionsV2 = VerificationTransaction::where('verification_type', 'v2');
        $verificationTotalCountV2 = $verificationTransactionsV2->count();
        $verificationPendingCountV2 = $verificationTransactionsV2->where('status', 'pending')->count();

        // Retrieve and count verification transactions
        $verificationTransactions = VerificationTransaction::where('verification_type', 'v1');
        $verificationTotalCount = $verificationTransactions->count();
        $verificationPendingCount = $verificationTransactions->where('status', 'pending')->count();

        // Retrieve and count validation transactions
        $validationTransactions = ValidationTransaction::all();
        $validationTotalCount = $validationTransactions->count();
        $validationPendingCount = $validationTransactions->where('status', 'pending')->count();

        // Retrieve and count IPE transactions
        $ipeTransactions = IPEClearanceTransaction::all();
        $ipeTotalCount = $ipeTransactions->count();
        $ipePendingCount = $ipeTransactions->where('status', 'pending')->count();

        // Retrieve and count new enrollment transactions
        $newEnrollmentTransactions = NewEnrollmentTransaction::all();
        $newEnrollmentTotalCount = $newEnrollmentTransactions->count();
        $newEnrollmentPendingCount = $newEnrollmentTransactions->where('status', 'pending')->count();

        // Retrieve and count personalization transactions
        $personalizationTransactions = PersonalizationTransaction::all();
        $personalizationTotalCount = $personalizationTransactions->count();
        $personalizationPendingCount = $personalizationTransactions->where('status', 'pending')->count();

        // Retrieve and count modification transactions
        $modificationTransactions = ModificationTransaction::all();
        $modificationTotalCount = $modificationTransactions->count();
        $modificationPendingCount = $modificationTransactions->where('status', 'pending')->count();

        // Calculate total counts for all transaction types
        $totalTransactionsCount = $pukTotalCount + $verificationTotalCount + $validationTotalCount + $ipeTotalCount + $newEnrollmentTotalCount + $personalizationTotalCount + $modificationTotalCount;

        // Calculate total pending counts for all transaction types
        $totalPendingCount = $pukPendingCount + $verificationPendingCount + $validationPendingCount + $ipePendingCount + $newEnrollmentPendingCount + $personalizationPendingCount + $modificationPendingCount;

        // Pass counts and transactions to the view
        return view('admin.dashboard', compact(
            'pukTotalCount', 'pukPendingCount',
            'verificationTotalCount', 'verificationPendingCount',
            'verificationTotalCountV2', 'verificationPendingCountV2',
            'validationTotalCount', 'validationPendingCount',
            'ipeTotalCount', 'ipePendingCount',
            'newEnrollmentTotalCount', 'newEnrollmentPendingCount',
            'personalizationTotalCount', 'personalizationPendingCount',
            'modificationTotalCount', 'modificationPendingCount',
            'totalTransactionsCount', 'totalPendingCount'
        ));                
    }

    public function verification()
    {
        $admin = auth()->user();
        if ($admin->role !== 'Administrator'){
            return back()->with('error', 'Unauthorized access');
        }

        $transactions = VerificationTransaction::orderBy('created_at', 'desc')
                                                ->where('verification_type', 'v1')
                                                ->paginate(10);

        return view('admin.verification', compact('transactions'));
    }

    public function verificationV2()
    {
        $admin = auth()->user();
        if ($admin->role !== 'Administrator'){
            return back()->with('error', 'Unauthorized access');
        }

        $transactions = VerificationTransaction::orderBy('created_at', 'desc')
                                                ->where('verification_type', 'v2')
                                                ->paginate(10);

        return view('admin.verification-2', compact('transactions'));
    }

    public function validation()
    {
        $admin = auth()->user();
        if ($admin->role !== 'Administrator'){
            return back()->with('error', 'Unauthorized access');
        }

        $transactions = ValidationTransaction::orderBy('created_at', 'desc')
                                                ->paginate(10);

        return view('admin.validation', compact('transactions'));
    }

    public function ipeClearance()
    {
        $admin = auth()->user();
        if ($admin->role !== 'Administrator'){
            return back()->with('error', 'Unauthorized access');
        }

        $transactions = IPEClearanceTransaction::orderBy('created_at', 'desc')->paginate(10);

        return view('admin.ipe-clearance', compact('transactions'));
    }

    public function newEnrollment()
    {
        $admin = auth()->user();
        if ($admin->role !== 'Administrator'){
            return back()->with('error', 'Unauthorized access');
        }

        $transactions = NewEnrollmentTransaction::orderBy('created_at', 'desc')->paginate(10);

        return view('admin.new-enrollment', compact('transactions'));
    }

    public function modification()
    {
        $admin = auth()->user();
        if ($admin->role !== 'Administrator'){
            return back()->with('error', 'Unauthorized access');
        }

        $transactions = ModificationTransaction::orderBy('created_at', 'desc')->paginate(10);

        return view('admin.modification', compact('transactions'));
    }

    public function personalization()
    {
        $admin = auth()->user();
        if ($admin->role !== 'Administrator'){
            return back()->with('error', 'Unauthorized access');
        }

        $transactions = PersonalizationTransaction::orderBy('created_at', 'desc')->paginate(10);

        return view('admin.personalization', compact('transactions'));
    }

    public function puk()
    {
        $admin = auth()->user();
        if ($admin->role !== 'Administrator'){
            return back()->with('error', 'Unauthorized access');
        }

        $transactions = PUKTransaction::orderBy('created_at', 'desc')->paginate(10);

        return view('admin.puk', compact('transactions'));
    }

    public function withdrawals()
    {
        $admin = auth()->user();
        if ($admin->role !== 'Administrator'){
            return back()->with('error', 'Unauthorized access');
        }

        $withdrawals = Withdrawal::with('user')->orderBy('created_at', 'desc')->paginate(10);

        return view('admin.withdrawals', compact('withdrawals'));
    }

}
