<?php
namespace App\Http\Controllers\API;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use \Illuminate\Support\Facades\Validator;
use App\Http\Controllers\API\ResponseObject;
use \Illuminate\Support\Facades\Response as FacadeResponse;

use function GuzzleHttp\json_encode;

class RegisteredUserController extends Controller
{
    
    /**
     * Handle an incoming registration request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
 // dd(json_encode($request->name));
        $response = new ResponseObject;
        $validator = Validator::make($request->all(), [
            'name' => 'required|array',
            //'name.*' => 'required|string|min:1|max:255',
            'phone' => 'required_without:email|numeric|unique:users,phone',
            'email' => 'required_without:phone|email|max:255|unique:users,email',
            'password' => 'required|confirmed',
        ]);

        if($validator->fails()){
            $response->status = $response::status_fail;
            $response->code = $response::code_failed;
            foreach ($validator->errors()->getMessages() as $item) {
                array_push($response->messages, $item);
            }
        } else {

            $user = User::create([
                'name' => $request->name,
                'phone' => $request->phone,
                'email' => $request->email,
                'password' => Hash::make($request->password),

            ]);
            $token = $user->createToken('authtoken');
            $response->status = $response::status_ok;
            $response->code = $response::code_ok;
            $response->result = [$user,$token];
        }
        return FacadeResponse::json($response);
    }
}
