<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AgentController extends Controller
{
    public function makeAgent(Request $request)
    {
        $user = auth()->user();

        $user->role = 'Agent';
        $user->save();

        return redirect()->back()->with('success', 'User role updated to Agent.');
    }
}
