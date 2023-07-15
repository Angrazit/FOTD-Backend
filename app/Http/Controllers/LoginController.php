<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    //
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            // $token = $this->createToken('')->plainTextToken;
            return response()->json(['user' => $user], /*'token' => $token,*/ 200);
        }
        return response()->json(['error' => 'Unauthorized'], 401);
    }
}
