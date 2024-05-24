<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class SlipController extends Controller
{
    public function premium(Request $request)
    {
        $data = Session::get('slipData');

        if (!$data) {
            return back()->with('error', 'No verification data found.');
        }
        
        return view('slip.premium', compact('data'));
    }

    public function standard(Request $request)
    {
        $data = Session::get('slipData');

        if (!$data) {
            return back()->with('error', 'No verification data found.');
        }

        return view('slip.standard', compact('data'));
    }

    public function improved(Request $request)
    {
        $data = Session::get('slipData');

        if (!$data) {
            return back()->with('error', 'No verification data found.');
        }

        return view('slip.improved', compact('data'));
    }

    public function basic(Request $request)
    {
        $data = Session::get('slipData');

        if (!$data) {
            return back()->with('error', 'No verification data found.');
        }

        return view('slip.basic', compact('data'));
    }

    public function nvs(Request $request)
    {
        $data = Session::get('slipData');

        if (!$data) {
            return back()->with('error', 'No verification data found.');
        }

        return view('slip.nvs', compact('data'));
    }
}
