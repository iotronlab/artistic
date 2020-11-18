<?php

namespace App\Http\Controllers\api\auth;

use App\Events\CustomerRegistered;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Customer\Customer;

class RegisterController extends Controller
{
    public function register(Request $request)
    {
        $validator =
            $request->validate([
                'name' => 'required',
                'email' => 'required|email',
                'password' => 'required',
                'c_password' => 'required|same:password'
            ]);




        //checking if the email is verified with otp
        $otpVerified = true;
        //OtpVerify::where('temp_email', $request->email)->first();




        if ($otpVerified && $validator) {


            $input = $request->all();
            $input['password'] = bcrypt($input['password']);
            $user = Customer::create($input);
            Auth::login($user);
            $accessToken = Auth::user()->createToken('authToken')->accessToken;
            // Mail::to($request->email)->send(new WelcomeUser($input));
            //Triggers event queue
            event(new CustomerRegistered($user));
            return response()->json([
                'success' => true, 'message' => 'Account created successfully.',
                'token' => $accessToken
            ], 200);
        } else {
            return response()->json(['success' => false, 'message' => 'error'], 400);
        }
    }
}
