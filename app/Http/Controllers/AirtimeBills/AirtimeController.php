<?php

namespace App\Http\Controllers\AirtimeBills;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\AirtimeService;
use Carbon\Carbon;

class AirtimeController extends Controller
{
    protected $airtimeService;

    public function __construct(AirtimeService $airtimeService)
    {
        $this->airtimeService = $airtimeService;
    }

    public function airtimeIndex()
    {
        return view('airtime');
    }

    public function airtimePurchase(Request $request)
    {
        $validated = $request->validate([
            'provider' => 'required|string',
            'phone' => 'required|string',
            'amount' => 'required|numeric',
        ]);

        $requestId = $this->generateRequestId();

        $result = $this->airtimeService->purchaseProduct(
            $requestId,
            $validated['provider'],
            $validated['amount'],
            $validated['phone']
        );

        return response()->json($result);
    }

    private function generateRequestId()
    {
        $timestamp = Carbon::now('Africa/Lagos')->format('YmdHi');
        $uniqueString = bin2hex(random_bytes(6));
        return $timestamp . $uniqueString;
    }
}
