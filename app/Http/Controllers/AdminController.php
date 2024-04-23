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

class AdminController extends Controller
{
    public function dashboard()
    {
        $admin = auth()->user();
        if ($admin->role !== 'Administrator'){
            return back()->with('error', 'Unauthorized access');
        }
                
        return view('admin.dashboard');
    }

    public function verification()
    {
        $admin = auth()->user();
        if ($admin->role !== 'Administrator'){
            return back()->with('error', 'Unauthorized access');
        }

        $transactions = VerificationTransaction::orderBy('created_at', 'desc')->get();

        return view('admin.verification', compact('transactions'));
    }

    public function validation()
    {
        $admin = auth()->user();
        if ($admin->role !== 'Administrator'){
            return back()->with('error', 'Unauthorized access');
        }

        $transactions = ValidationTransaction::orderBy('created_at', 'desc')->get();

        return view('admin.validation', compact('transactions'));
    }

    public function ipeClearance()
    {
        $admin = auth()->user();
        if ($admin->role !== 'Administrator'){
            return back()->with('error', 'Unauthorized access');
        }

        $transactions = IPEClearanceTransaction::orderBy('created_at', 'desc')->get();

        return view('admin.ipe-clearance', compact('transactions'));
    }

    public function newEnrollment()
    {
        $admin = auth()->user();
        if ($admin->role !== 'Administrator'){
            return back()->with('error', 'Unauthorized access');
        }

        $transactions = NewEnrollmentTransaction::orderBy('created_at', 'desc')->get();

        return view('admin.new-enrollment', compact('transactions'));
    }

    public function modification()
    {
        $admin = auth()->user();
        if ($admin->role !== 'Administrator'){
            return back()->with('error', 'Unauthorized access');
        }

        $transactions = ModificationTransaction::orderBy('created_at', 'desc')->get();

        return view('admin.modification', compact('transactions'));
    }

    public function personalization()
    {
        $admin = auth()->user();
        if ($admin->role !== 'Administrator'){
            return back()->with('error', 'Unauthorized access');
        }

        $transactions = PersonalizationTransaction::orderBy('created_at', 'desc')->get();

        return view('admin.personalization', compact('transactions'));
    }

    public function puk()
    {
        $admin = auth()->user();
        if ($admin->role !== 'Administrator'){
            return back()->with('error', 'Unauthorized access');
        }

        $transactions = PUKTransaction::orderBy('created_at', 'desc')->get();;

        return view('admin.puk', compact('transactions'));
    }
}
