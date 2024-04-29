<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\DB;



class AgentController extends Controller
{  
    public function makeAgent(Request $request)
    {
        try{   
            DB::beginTransaction();

            $user = auth()->user();
        
            $user->role = 'Agent';
            $user->save();
        
            // $paystackCustomerCode = $this->createPaystackCustomer($user);
        
            // if ($paystackCustomerCode) {
            //     $user->paystack_customer_code = $paystackCustomerCode;
            //     $user->save();

                DB::commit();
                
                return redirect()->back()->with('success', 'User role updated to Agent.');
            // } else {
            //     DB::rollBack();
            //     return redirect()->back()->with('error', 'Failed to create Paystack customer.');
            // }
        } catch(\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
    // protected function createPaystackCustomer($user) {
    //     $response = Http::withHeaders([
    //         'Authorization' => 'Bearer ' . env('PAYSTACK_SECRET_KEY'),
    //         'Content-Type' => 'application/json',
    //     ])->post('https://api.paystack.co/customer', [
    //         'email' => $user->email,
    //         'first_name' => $user->first_name, 
    //         'last_name' => $user->last_name,
    //         'phone' => $user->phone,
    //     ]);
    
    //     if ($response->successful()) {
    //         return $response->json()['data']['customer_code']; 
    //     }
    //     return null;
    // }
    
}
