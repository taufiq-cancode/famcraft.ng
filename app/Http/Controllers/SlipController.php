<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SlipController extends Controller
{
    public function premium(Request $request)
    {
        $data = $request->query('data');
        return view('slip.premium', compact('data'));
    }

    public function standard(Request $request)
    {
        $data = $request->query('data');
        return view('slip.standard', compact('data'));
    }

    public function improved(Request $request)
    {
        $data = $request->query('data');
        return view('slip.improved', compact('data'));
    }

    public function basic(Request $request)
    {
        $data = $request->query('data');
        return view('slip.basic', compact('data'));
    }

    public function nvs(Request $request)
    {
        $data = $request->query('data');
        return view('slip.nvs', compact('data'));
    }
}
