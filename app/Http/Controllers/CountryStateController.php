<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class CountryStateController extends Controller
{

    public function showForm()
    {
         
        return view('ne', compact('countries'));
    }

    // public function getCountries()
    // {
    //     $response = Http::withHeaders([
    //         'X-CSCAPI-KEY' => 'YOUR_API_KEY_HERE'
    //     ])->get('https://api.countrystatecity.in/v1/countries');

    //     return $response->json();
    // }

    // public function getStates($countryIso)
    // {
    //     $response = Http::withHeaders([
    //         'X-CSCAPI-KEY' => 'YOUR_API_KEY_HERE'
    //     ])->get("https://api.countrystatecity.in/v1/countries/{$countryIso}/states");

    //     return $response->json();
    // }
}
