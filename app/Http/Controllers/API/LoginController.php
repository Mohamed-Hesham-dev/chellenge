<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use Twilio\Rest\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Validator;

class LoginController extends Controller
{
   
    public function login(Request $request)
    {
     

       if($request->has('phone')){
        $user = User::where('phone', $request->phone)->firstOrFail();
        $code = rand(1, 9999);
        //dd($code);
        $user->update(['code'=>$code]);
        $this->sendMessage($code,'+'.$request->phone);
       
    }elseif( $request->has('email')){

        $user = User::where('email', $request->email)->first();
    }

        if ($user) {
            if (Hash::check($request->password, $user->password)) {
                $token = $user->createToken('authtoken');
                $response = ["message" =>'User Login and we have send code','token'=>  $token];
              
                return response($response, 200);
            } else {
                $response = ["message" => "Password mismatch"];
                return response($response, 400);
            }
        } else {
            $response = ["message" =>'User does not exist'];
            return response($response, 400);
        }
       }
       
       private function sendMessage($code, $phone)
       {
           $account_sid =$_ENV["TWILIO_SID"];
           $auth_token = $_ENV["TWILIO_AUTH_TOKEN"];
           $twilio_number =$_ENV["TWILIO_NUMBER"];
           $client = new Client($account_sid, $auth_token);
           $client->messages->create($phone, ['from' => $twilio_number, 'body' => "Please Use this Code'.$code' To verify account"]);
       }
    
}
