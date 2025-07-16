<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class LoginController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string|min:5'
        ]);
        if (!Auth::attempt($request->only('email','password'))){
            return response()->json(['message' => 'Unauthorized'], 401);
        }
        $user = Auth::user();
        $token = $user->createToken('UserToken')->accessToken;

        return response()->json([
            'user' => $user,
            'token' => $token,
        ]);
    }
}
