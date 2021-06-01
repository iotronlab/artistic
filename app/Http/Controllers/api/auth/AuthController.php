<?php

namespace App\Http\Controllers\api\auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        //  $credentials = $request->only('email', 'password');

        if (Auth::guard('customer')->attempt($credentials)) {
            $user = auth()->guard('customer')->user();
            // $request->session()->regenerate();
            // $user = Auth::user();
            $accessToken = $user->createToken('authToken')->plainTextToken;

            return response()->json(['success' => true, 'accessToken' => $accessToken], 200);
        } else {

            return response()->json(['success' => false, 'Authetication failed.'], 400);
        }
    }

    public function details()
    {
        //$user = Auth::user();
        $user = auth('cust-api')->user();
        return response()->json(['data' => $user, 200]);
    }


    public function logout(Request $request)
    {
        $request->user('cust-api')->tokens()->delete();
        return response()->json(['message' => 'Successfully logged out'], 200);
    }
}
