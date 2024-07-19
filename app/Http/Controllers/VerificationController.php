<?php

namespace App\Http\Controllers;

use App\Models\Pricing;
use App\Models\VerificationTransaction;
use Carbon\Carbon;
use Dompdf\Options;
use Exception;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use Dompdf\Dompdf;
use Spatie\PdfToImage\Exceptions\PdfDoesNotExist;
use Spatie\LaravelPdf\Facades\Pdf;

class VerificationController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $transactions = VerificationTransaction::where('user_id', $user->id)
                                            ->where('verification_type', 'v1')
                                            ->orderBy('created_at', 'desc')
                                            ->paginate(10);
        return view('verification', compact('transactions'));
    }

    public function store(Request $request)
    {
        try {
            DB::beginTransaction();

            $user = auth()->user();

            $data = $request->validate([
                'method' => 'required|string|in:by-demographics,by-phone,by-nin',
                'slip_type' => 'required|string|in:premium-slip,standard-slip,improved-nin-slip,basic-slip,nvs-slip',
                'nin' => 'nullable|integer',
                'surname' => 'nullable|string|max:255',
                'firstname' => 'nullable|string|max:255',
                'gender' => 'nullable|string|in:male,female',
                'dob' => 'nullable|date',
                'phone' => 'nullable|string',
            ]);

            $data['user_id'] = $user->id;
            $data['verification_type'] = 'v1';


            if (!empty($data['dob'])) {
                $data['dob'] = Carbon::createFromFormat('Y-m-d', $request->dob)->format('d-m-Y');
                $formattedDateForDB = $request->dob;
            } else {
                $formattedDateForDB = null;
            }

            $serviceFee = 0;
            $slipFee = 0;

            $service = Pricing::where('item_name', 'per-verification-request')->first();
            $serviceFee = $service->price ?? null;

            $slipType = $data['slip_type'];
            if ($slipType === 'premium-slip') {
                $slip = Pricing::where('item_name', 'premium-slip')->first();
            } elseif ($slipType === 'standard-slip') {
                $slip = Pricing::where('item_name', 'standard-slip')->first();
            } elseif ($slipType === 'improved-nin-slip') {
                $slip = Pricing::where('item_name', 'improved-nin-slip')->first();
            } elseif ($slipType === 'basic-slip') {
                $slip = Pricing::where('item_name', 'basic-slip')->first();
            }

            $slipFee = $slip->price ?? null;
            $cost = $serviceFee + $slipFee;

            if ($data['method'] === 'by-nin') {
                $response = $this->sendVerificationRequest($data['nin']);

                if ($response->getStatusCode() === 200) {
                    $verificationData = json_decode($response->getBody(), true);

                    if (isset($verificationData['status']) && $verificationData['status'] !== true) {
                        DB::rollBack();
                        return back()->with('error', 'Error verifying NIN. Try again later');
                    }

                    if (isset($verificationData['message']) && $verificationData['message'] === 'norecord') {
                        DB::rollBack();
                        return back()->with('error', 'No record found.');
                    }

                    if ($user->wallet->balance < $cost) {
                        DB::rollBack();
                        return back()->with('error', 'Insufficient balance.');
                    }

                    $user->wallet->balance -= $cost;
                    $user->wallet->save();

                    $transactionId = 'VER' . rand(100000, 999999);
                    while (VerificationTransaction::where('transaction_id', $transactionId)->exists()) {
                        $transactionId = 'VER' . rand(100000, 999999);
                    }

                    $data['transaction_id'] = $transactionId;
                    $data['price'] = $cost;
                    $data['status'] = 'success';

                    $verification = VerificationTransaction::create($data);

                    if ($verification) {
                        if (is_array($verificationData['message'])) {
                            $base64Image = $verificationData['message']['image'];
                            $imageData = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $base64Image));

                            $base64Sign = $verificationData['message']['signature'];
                            $signData = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $base64Sign));
                        } else {
                            return back()->with('error', 'Error processing verification.');
                        }

                        $verificationData['image_data'] = $imageData;
                        $imagePath = $imageData;

                        $verificationData['sign_data'] = $signData;
                        $signPath = $signData;

                        $slip = $data['slip_type'];
                        $surname = $verificationData['message']['lastName'] ?? null;
                        $photo = $verificationData['image_data'] ?? null;
                        $signature = $verificationData['sign_data'] ?? null;
                        $firstname = $verificationData['message']['firstName'] ?? null;
                        $nin = $verificationData['message']['idNumber'] ?? null;
                        $dob = $verificationData['message']['dateOfBirth'] ?? null;
                        $dob = Carbon::createFromFormat('Y-m-d', $dob)->format('d-m-Y');
                        $gender = $verificationData['message']['gender'] ?? null;
                        $tracking_id = $verificationData['message']['trackingId'] ?? null;
                        $middlename = $verificationData['message']['middleName'] ?? null;
                        $phone = $verificationData['message']['telephoneno'] ?? null;
                        $dateObj = Carbon::createFromFormat('d-m-Y', $dob) ?? null;
                        $formattedDob = $dateObj->format('d-M-Y') ?? null;
                        $currentDate = Carbon::now()->format('jS M Y') ?? null;
                        $fname = $firstname . $middlename;
                        $currentDate = Carbon::now()->format('jS M Y') ?? null;
                        $heigth = $verificationData['message']['heigth'] ?? null;
                        $nok_address1 = $verificationData['message']['nok_address1'] ?? null;
                        $nok_town = $verificationData['message']['nok_town'] ?? null;
                        $spoken_language = $verificationData['message']['nspokenlang'] ?? null;
                        $profession = $verificationData['message']['profession'] ?? null;
                        $religion = $verificationData['message']['religion'] ?? null;
                        $restown = $verificationData['message']['town'] ?? null;
                        $residencestatus = $verificationData['message']['residencestatus'] ?? null;
                        $title = $verificationData['message']['title'] ?? null;
                        $email = $verificationData['message']['email'] ?? null;
                        $state = $verificationData['message']['state'] ?? null;
                        $lg = $verificationData['message']['lga'] ?? null;
                        $birthcountry = $verificationData['message']['birthCountry'] ?? null;
                        $birthstate = $verificationData['message']['birthState'] ?? null;
                        $birthlga = $verificationData['message']['birthLGA'] ?? null;
                        $address = $verificationData['message']['addressLine'] ?? null;
                        $text = "surname: " . $surname . " | givenNames: " . $fname . " | dob: " . $dob . " ;";

                        $url = "https://api.qrserver.com/v1/create-qr-code/?data=" . urlencode($text) . "&size=100x100";

                        $response = file_get_contents($url);

                        if ($response === false) {
                            return back()->with('error', 'An error occurred. Please try again later.');
                        }

                        $qrname = "qrimages/qr_" . $nin . ".png";
                        Storage::disk('public')->put($qrname, $response);

                        $data = [
                            'slipType' => $slip,
                            'surname' => $surname,
                            'firstname' => $firstname,
                            'middlename' => $middlename,
                            'formattedDob' => $formattedDob,
                            'gender' => strtoupper($gender),
                            'nin' => $nin,
                            'currentDate' => $currentDate,
                            'photo' => $photo,
                            'signature' => $signature,
                            'qrPath' => $qrname,
                            'state' => $state,
                            'address' => $address,
                            'lg' => $lg,
                            'tracking_id' => $tracking_id,
                            'birthstate' => $birthstate,
                            'birthlga' => $birthlga,
                            'restown' => $restown,
                        ];

                        DB::commit();

                        Session::put('slipData', $data);

                        return redirect()->route('verification.response')
                            ->with([
                                'verificationData' => $verificationData,
                                'imagePath' => $imagePath,
                        ]);                    
                    }
                    
                } else {
                    return back()->with('error', 'An error occurred. Please try again later.');
                } 

            } elseif ($data['method'] === 'by-phone') {
                $phoneVerificationResponse = $this->sendPhoneVerificationRequest($data['phone']);

                if ($phoneVerificationResponse->getStatusCode() === 200) {
                    // Process phone verification response
                    $verificationData = json_decode($phoneVerificationResponse->getBody(), true);

                    if (isset($verificationData['status']) && $verificationData['status'] !== true) {
                        DB::rollBack();
                        return back()->with('error', 'Error verifying NIN. Try again later');
                    }

                    if (isset($verificationData['message']) && $verificationData['message'] === 'norecord') {
                        DB::rollBack();
                        return back()->with('error', 'No record found.');
                    }

                    if ($user->wallet->balance < $cost) {
                        DB::rollBack();
                        return back()->with('error', 'Insufficient balance.');
                    }

                    $user->wallet->balance -= $cost;
                    $user->wallet->save();

                    $transactionId = 'VER' . rand(100000, 999999);
                    while (VerificationTransaction::where('transaction_id', $transactionId)->exists()) {
                        $transactionId = 'VER' . rand(100000, 999999);
                    }

                    $data['transaction_id'] = $transactionId;
                    $data['price'] = $cost;
                    $data['status'] = 'success';

                    $verification = VerificationTransaction::create($data);

                    if ($verification) {
                        if (is_array($verificationData['message'])) {
                            $base64Image = $verificationData['message']['image'];
                            $imageData = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $base64Image));

                            $base64Sign = $verificationData['message']['signature'];
                            $signData = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $base64Sign));
                        } else {
                            return back()->with('error', 'Error processing verification.');
                        }

                        $verificationData['image_data'] = $imageData;
                        $imagePath = $imageData;

                        $verificationData['sign_data'] = $signData;
                        $signPath = $signData;

                        $slip = $data['slip_type'];
                        $surname = $verificationData['message']['lastName'] ?? null;
                        $photo = $verificationData['image_data'] ?? null;
                        $signature = $verificationData['sign_data'] ?? null;
                        $firstname = $verificationData['message']['firstName'] ?? null;
                        $nin = $verificationData['message']['idNumber'] ?? null;
                        $dob = $verificationData['message']['dateOfBirth'] ?? null;
                        $dob = Carbon::createFromFormat('Y-m-d', $dob)->format('d-m-Y');
                        $gender = $verificationData['message']['gender'] ?? null;
                        $tracking_id = $verificationData['message']['trackingId'] ?? null;
                        $middlename = $verificationData['message']['middleName'] ?? null;
                        $phone = $verificationData['message']['telephoneno'] ?? null;
                        $dateObj = Carbon::createFromFormat('d-m-Y', $dob) ?? null;
                        $formattedDob = $dateObj->format('d-M-Y') ?? null;
                        $currentDate = Carbon::now()->format('jS M Y') ?? null;
                        $fname = $firstname . $middlename;
                        $currentDate = Carbon::now()->format('jS M Y') ?? null;
                        $heigth = $verificationData['message']['heigth'] ?? null;
                        $nok_address1 = $verificationData['message']['nok_address1'] ?? null;
                        $nok_town = $verificationData['message']['nok_town'] ?? null;
                        $spoken_language = $verificationData['message']['nspokenlang'] ?? null;
                        $profession = $verificationData['message']['profession'] ?? null;
                        $religion = $verificationData['message']['religion'] ?? null;
                        $restown = $verificationData['message']['town'] ?? null;
                        $residencestatus = $verificationData['message']['residencestatus'] ?? null;
                        $title = $verificationData['message']['title'] ?? null;
                        $email = $verificationData['message']['email'] ?? null;
                        $state = $verificationData['message']['state'] ?? null;
                        $lg = $verificationData['message']['lga'] ?? null;
                        $birthcountry = $verificationData['message']['birthcountry'] ?? null;
                        $birthstate = $verificationData['message']['birthstate'] ?? null;
                        $birthlga = $verificationData['message']['birthlga'] ?? null;
                        $address = $verificationData['message']['addressLine'] ?? null;
                        $text = "surname: " . $surname . " | givenNames: " . $fname . " | dob: " . $dob . " ;";

                        $url = "https://api.qrserver.com/v1/create-qr-code/?data=" . urlencode($text) . "&size=100x100";

                        $response = file_get_contents($url);

                        if ($response === false) {
                            return back()->with('error', 'An error occurred. Please try again later.');
                        }

                        $qrname = "qrimages/qr_" . $nin . ".png";
                        Storage::disk('public')->put($qrname, $response);

                        $data = [
                            'slipType' => $slip,
                            'surname' => $surname,
                            'firstname' => $firstname,
                            'middlename' => $middlename,
                            'formattedDob' => $formattedDob,
                            'gender' => strtoupper($gender),
                            'nin' => $nin,
                            'currentDate' => $currentDate,
                            'photo' => $photo,
                            'signature' => $signature,
                            'qrPath' => $qrname,
                            'state' => $state,
                            'address' => $address,
                            'lg' => $lg,
                            'tracking_id' => $tracking_id,
                            'birthstate' => $birthstate,
                            'birthlga' => $birthlga,
                            'restown' => $restown,
                        ];

                        DB::commit();

                        Session::put('slipData', $data);

                        return redirect()->route('verification.response')
                            ->with([
                                'verificationData' => $verificationData,
                                'imagePath' => $imagePath,
                        ]);                    
                    }
                } else {
                    DB::rollBack();
                    return back()->with('error', 'Error verifying phone. Try again later.');
                }

            } elseif ($data['method'] === 'by-demographics') {
            
                $demographicsVerificationResponse = $this->sendDemographicsVerificationRequest($data);

                if ($demographicsVerificationResponse->getStatusCode() === 200) {
                    $verificationData = json_decode($demographicsVerificationResponse->getBody(), true);

                    if (isset($verificationData['status']) && $verificationData['status'] !== true) {
                        DB::rollBack();
                        return back()->with('error', 'Error verifying NIN. Try again later');
                    }

                    if (isset($verificationData['message']) && $verificationData['message'] === 'norecord') {
                        DB::rollBack();
                        return back()->with('error', 'No record found.');
                    }

                    if ($user->wallet->balance < $cost) {
                        DB::rollBack();
                        return back()->with('error', 'Insufficient balance.');
                    }

                    $user->wallet->balance -= $cost;
                    $user->wallet->save();

                    $transactionId = 'VER' . rand(100000, 999999);
                    while (VerificationTransaction::where('transaction_id', $transactionId)->exists()) {
                        $transactionId = 'VER' . rand(100000, 999999);
                    }

                    $data['transaction_id'] = $transactionId;
                    $data['price'] = $cost;
                    $data['dob'] = $formattedDateForDB;
                    $data['status'] = 'success';

                    $verification = VerificationTransaction::create($data);

                    if ($verification) {
                        if (is_array($verificationData['message'])) {
                            $base64Image = $verificationData['message']['photo'];
                            $imageData = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $base64Image));

                            $base64Sign = $verificationData['message']['signature'];
                            $signData = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $base64Sign));
                        } else {
                            return back()->with('error', 'Error processing verification.');
                        }

                        $verificationData['image_data'] = $imageData;
                        $imagePath = $imageData;

                        $verificationData['sign_data'] = $signData;
                        $signPath = $signData;

                        $slip = $data['slip_type'];
                        $surname = $verificationData['message']['surname'] ?? null;
                        $photo = $verificationData['image_data'] ?? null;
                        $signature = $verificationData['sign_data'] ?? null;
                        $firstname = $verificationData['message']['firstname'] ?? null;
                        $nin = $verificationData['message']['nin'] ?? null;
                        $dob = $verificationData['message']['birthdate'] ?? null;
                        $gender = $verificationData['message']['gender'] ?? null;
                        $tracking_id = $verificationData['message']['trackingId'] ?? null;
                        $middlename = $verificationData['message']['middlename'] ?? null;
                        $phone = $verificationData['message']['telephoneno'] ?? null;
                        $dateObj = Carbon::createFromFormat('d-m-Y', $dob) ?? null;
                        $formattedDob = $dateObj->format('d-M-Y') ?? null;
                        $currentDate = Carbon::now()->format('jS M Y') ?? null;
                        $fname = $firstname . $middlename;
                        $currentDate = Carbon::now()->format('jS M Y') ?? null;
                        $heigth = $verificationData['message']['heigth'] ?? null;
                        $nok_address1 = $verificationData['message']['nok_address1'] ?? null;
                        $nok_town = $verificationData['message']['nok_town'] ?? null;
                        $spoken_language = $verificationData['message']['nspokenlang'] ?? null;
                        $profession = $verificationData['message']['profession'] ?? null;
                        $religion = $verificationData['message']['religion'] ?? null;
                        $restown = $verificationData['message']['residence_Town'] ?? null;
                        $residencestatus = $verificationData['message']['residencestatus'] ?? null;
                        $title = $verificationData['message']['title'] ?? null;
                        $email = $verificationData['message']['email'] ?? null;
                        $state = $verificationData['message']['residence_state'] ?? null;
                        $lg = $verificationData['message']['residence_lga'] ?? null;
                        $birthcountry = $verificationData['message']['birthcountry'] ?? null;
                        $birthstate = $verificationData['message']['birthstate'] ?? null;
                        $birthlga = $verificationData['message']['birthlga'] ?? null;
                        $address = $verificationData['message']['residence_AdressLine1'] ?? null;
                        $text = "surname: " . $surname . " | givenNames: " . $fname . " | dob: " . $dob . " ;";

                        $url = "https://api.qrserver.com/v1/create-qr-code/?data=" . urlencode($text) . "&size=100x100";

                        $response = file_get_contents($url);

                        if ($response === false) {
                            return back()->with('error', 'An error occurred. Please try again later.');
                        }

                        $qrname = "qrimages/qr_" . $nin . ".png";
                        Storage::disk('public')->put($qrname, $response);

                        $data = [
                            'slipType' => $slip,
                            'surname' => $surname,
                            'firstname' => $firstname,
                            'middlename' => $middlename,
                            'formattedDob' => $formattedDob,
                            'gender' => strtoupper($gender),
                            'nin' => $nin,
                            'currentDate' => $currentDate,
                            'photo' => $photo,
                            'signature' => $signature,
                            'qrPath' => $qrname,
                            'state' => $state,
                            'address' => $address,
                            'lg' => $lg,
                            'tracking_id' => $tracking_id,
                            'birthstate' => $birthstate,
                            'birthlga' => $birthlga,
                            'restown' => $restown,
                        ];

                        DB::commit();

                        Session::put('slipData', $data);

                        return redirect()->route('verification.response')
                            ->with([
                                'verificationData' => $verificationData,
                                'imagePath' => $imagePath,
                        ]);                    
                    }
                } else {
                    DB::rollBack();
                    return back()->with('error', 'Error verifying demographics. Try again later.');
                }

            } else {
                if ($user->wallet->balance < $cost) {
                    DB::rollBack();
                    return back()->with('error', 'Insufficient balance.');
                }

                $user->wallet->balance -= $cost;
                $user->wallet->save();

                $transactionId = 'VER' . rand(100000, 999999);
                while (VerificationTransaction::where('transaction_id', $transactionId)->exists()) {
                    $transactionId = 'VER' . rand(100000, 999999);
                }

                $data['transaction_id'] = $transactionId;
                $data['price'] = $cost;
                $data['dob'] = $formattedDateForDB;

                $verification = VerificationTransaction::create($data);
                
                if ($verification) {
                    DB::commit();
                    return back()->with('success', 'Verification request submitted successfully.');
                }
            }            
        } catch(Exception $e) {
            DB::rollBack();
            return back()->with('error', $e->getMessage());
        }
    }

    private function sendVerificationRequest($nin)
    {
        try {
            $client = new Client();

            $headers = [
                'Authorization' => 'Bearer ' . env('VERIFICATION_API_TOKEN'),
                'Content-Type' => 'application/json',
            ];

            try {
                $response = $client->post('https://directverify.com.ng/api/nin/index', [
                    'headers' => $headers,
                    'json' => [
                        'idNumber' => $nin,
                        'idType' => 'NIN',
                        'consent' => true,
                    ]
                ]);
            } catch (\GuzzleHttp\Exception\RequestException $e) {
                return back()->with('error', 'Connection error occurred. Please try again later.');
            }            

            Log::info('Verification API Request: ' . json_encode([
                'idNumber' => $nin,
                'idType' => 'NIN',
                'consent' => true,
            ]));

            Log::info('Verification API Response: ' . $response->getBody()->getContents());    

            return $response;

        } catch (\GuzzleHttp\Exception\RequestException $e) {
            if ($e->hasResponse()) {
                return back()->with('error', 'Connection error occurred. Please try again later.');
            } else {
                return back()->with('error', 'Connection error occurred. Please try again later.');
            }
        } catch (Exception $e) {
            Log::error('Error sending verification request: ' . $e->getMessage());
            return back()->with('error', 'Error sending verification request. Please try again later.');
        }
    }

    private function sendPhoneVerificationRequest($phone)
    {
        $client = new Client();
        $headers = [
            'Authorization' => 'Bearer ' . env('VERIFICATION_API_TOKEN'),
            'Content-Type' => 'application/json',
        ];

        try {
            $response = $client->post('https://directverify.com.ng/api/pnv/index', [
                'headers' => $headers,
                'json' => [
                    'idNumber' => $phone,
                    'idType' => 'PNV',
                    'consent' => true,
                ]
            ]);

            Log::info('Phone Verification API Request: ' . json_encode([
                'phone' => $phone,
            ]));

            Log::info('Phone Verification API Response: ' . $response->getBody()->getContents());    

            return $response;

        } catch (\GuzzleHttp\Exception\RequestException $e) {
            if ($e->hasResponse()) {
                return back()->with('error', 'Connection error occurred. Please try again later.');
            } else {
                return back()->with('error', 'Connection error occurred. Please try again later.');
            }
        } catch (Exception $e) {
            Log::error('Error sending phone verification request: ' . $e->getMessage());
            return back()->with('error', 'Error sending phone verification request. Please try again later.');
        }
    }

    private function sendDemographicsVerificationRequest($data)
    {
        $client = new Client();
        $headers = [
            'Authorization' => 'Bearer ' . env('VERIFICATION_API_TOKEN'),
            'Content-Type' => 'application/json',
        ];

        try {
            $response = $client->post('https://directverify.com.ng/api/doc/index', [
                'headers' => $headers,
                'json' => [
                    'firstName' => $data['firstname'],
                    'lastName' => $data['surname'],
                    'gender' => $data['gender'],
                    'dob' => $data['dob'],
                    'phone' => $data['phone'],
                    'idType' => 'DOC',
                    'consent' => true,
                ]
            ]);

            Log::info('Demographics Verification API Request: ' . json_encode([
                'firstName' => $data['firstname'],
                'lastName' => $data['surname'],
                'gender' => $data['gender'],
                'dob' => $data['dob'],
                'phone' => $data['phone'],
                'idType' => 'DOC',
                'consent' => true,

            ]));

            Log::info('Demographics Verification API Response: ' . $response->getBody()->getContents());    

            return $response;

        } catch (\GuzzleHttp\Exception\RequestException $e) {
            if ($e->hasResponse()) {
                return back()->with('error', 'Connection error occurred. Please try again later.');
            } else {
                return back()->with('error', 'Connection error occurred. Please try again later.');
            }
        } catch (Exception $e) {
            Log::error('Error sending demographics verification request: ' . $e->getMessage());
            return back()->with('error', 'Error sending demographics verification request. Please try again later.');
        }
    }

    
    public function view($verificationId)
    {
        $transaction = VerificationTransaction::findOrFail($verificationId);
        return view('details.verification', compact('transaction'));
    }
    public function update(Request $request, $verificationId)
    {
        try {
            $admin = auth()->user();
            if ($admin->role !== 'Administrator'){
                return back()->with('error', 'Unauthorized access');
            }

            $verification = VerificationTransaction::findOrFail($verificationId);

            $data = $request->validate([
                'status' => 'sometimes',
                'response' => 'sometimes',
                'response_text' => 'sometimes',
                'response_pdf.*' => 'sometimes|mimes:pdf|max:2048',
            ]);

    
            if ($request->hasFile('response_pdf')) {
                $filePaths = [];
                foreach ($request->file('response_pdf') as $file) {
                    $path = $file->store('response_pdfs', 'public');
                    $filePaths[] = $path;
                }
                $data['response_pdf'] = array_merge((array) $verification->response_pdf, $filePaths);
            }

            $verification->update($data);

            return back()->with('success', 'Verification transaction updated successfully');

        } catch (Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }
}
