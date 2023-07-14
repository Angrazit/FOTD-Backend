<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;


class AuthController extends Controller
{
    //
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }
    public function handleGoogleCallback()
    {
        $user = Socialite::driver('google')->user();
        // Handle the user registration or authentication logic here
        // Retrieve user details
        $googleId = $user->getId();
        $name = $user->getName();
        $email = $user->getEmail();

        Session::put('googleUser', [
            'googleId' => $googleId,
            'name' => $name,
            'email' => $email,
        ]);
        return redirect('/register');
        
    }
    
    
    
}


