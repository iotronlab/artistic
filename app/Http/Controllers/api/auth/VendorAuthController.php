<?php

namespace App\Http\Controllers\api\auth;

use App\Http\Controllers\Controller;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VendorAuthController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        // $credentials = $request->only('email', 'password');

        if (Auth::guard('vendor')->attempt($credentials)) {
            $user = auth()->guard('vendor')->user();
            // $user = Auth::user();
            $accessToken = $user->createToken('authToken')->plainTextToken;

            return response()->json(['success' => true, 'accessToken' => $accessToken], 200);
        } else {
            //throw new AuthenticationException();
            return response()->json(['success' => false, 'Authentication failed.'], 400);
        }
    }

    public function details()
    {
        // $user = Auth::user();
        $user = auth('vendor-api')->user();
        return response()->json(['data' => $user, 200]);
    }


    public function logout(Request $request)
    {
        $request->user('vendor-api')->tokens()->delete();
        return response()->json(['message' => 'Successfully logged out'], 200);
    }
}
