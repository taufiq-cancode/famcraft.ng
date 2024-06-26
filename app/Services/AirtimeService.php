<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class AirtimeService
{
    protected $baseUrl;
    protected $apiKey;
    protected $secretKey;
    protected $publicKey;


    public function __construct()
    {
        $this->baseUrl = config('services.airtime.base_url');
        $this->apiKey = config('services.vtpass.api_key');
        $this->secretKey = config('services.vtpass.secret_key');
        $this->publicKey = config('services.vtpass.public_key');
    }

    public function purchaseProduct($requestId, $serviceId, $amount, $phone)
    {
        $response = Http::withHeaders([
            'api-key' => $this->apiKey,
            'secret-key' => $this->secretKey,
        ])->post("{$this->baseUrl}/pay", [
            'request_id' => $requestId,
            'serviceID' => $serviceId,
            'amount' => $amount,
            'phone' => $phone,
        ]);

        \Log::info('Request Data', [
            'headers' => [
                'api-key' => $this->apiKey,
                'secret-key' => $this->secretKey,
            ],
            'body' => [
                'request_id' => $requestId,
                'serviceID' => $serviceId,
                'amount' => $amount,
                'phone' => $phone,
            ],
            'response' => $response->json(),
        ]);

        return $response->json();
    }


    public function queryTransactionStatus($requestId)
    {
        $response = Http::withHeaders([
            'api-key' => $this->apiKey,
            'public-key' => $this->publicKey,
        ])->post("{$this->baseUrl}/requery", [
            'request_id' => $requestId,
        ]);

        return $response->json();
    }
}
