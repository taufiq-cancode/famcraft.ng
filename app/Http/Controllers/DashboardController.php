<?php

namespace App\Http\Controllers;

use App\Models\PricingCategory;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $pricing_categories = PricingCategory::with('pricings')->get();
            
        return view('dashboard', compact('pricing_categories'));
    }
}
