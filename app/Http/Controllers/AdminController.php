<?php

namespace App\Http\Controllers;

use App\Models\PUKTransaction;
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

        return view('admin.verification');
    }

    public function validation()
    {
        $admin = auth()->user();
        if ($admin->role !== 'Administrator'){
            return back()->with('error', 'Unauthorized access');
        }

        return view('admin.validation');
    }

    public function ipeClearance()
    {
        $admin = auth()->user();
        if ($admin->role !== 'Administrator'){
            return back()->with('error', 'Unauthorized access');
        }

        return view('admin.ipe-clearance');
    }

    public function newEnrollment()
    {
        $admin = auth()->user();
        if ($admin->role !== 'Administrator'){
            return back()->with('error', 'Unauthorized access');
        }
        
        return view('admin.new-enrollment');
    }

    public function modification()
    {
        $admin = auth()->user();
        if ($admin->role !== 'Administrator'){
            return back()->with('error', 'Unauthorized access');
        }

        return view('admin.modification');
    }

    public function personalization()
    {
        $admin = auth()->user();
        if ($admin->role !== 'Administrator'){
            return back()->with('error', 'Unauthorized access');
        }

        return view('admin.personalization');
    }

    public function puk()
    {
        $admin = auth()->user();
        if ($admin->role !== 'Administrator'){
            return back()->with('error', 'Unauthorized access');
        }

        $transactions = PUKTransaction::all();

        return view('admin.puk', compact('transactions'));
    }
}
