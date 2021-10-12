<?php


namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SmsVerificationController extends Controller
{
    public function sms(Request $request)
    {
        $user=auth('api')->user();
      
        if($user->code==$request->code){
            $carbon = new Carbon(); 
           // dd("here");
           $user->update(['phone_verified_at'=>$carbon]);
           return [
            'message'=>'Phone has been verified'
        ];
        }
       
        

    }
}
