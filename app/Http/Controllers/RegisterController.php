<?php

namespace App\Http\Controllers;

use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }
    
    public function handleGoogleCallback()
    {
        
        $googleUser = Socialite::driver('google')->user();
        
        // Check if the user already exists in your database
        $user = User::where('email', $googleUser->email)->first();
    
        if (!$user) {
            // User doesn't exist, create a new user record
            $user = User::create([
                'name' => $googleUser->name,
                'email' => $googleUser->email,
                // You can set other required fields here
            ]);
        }
    
        // Log in the user
        auth()->login($user);
    
        // Redirect the user to the desired route or homepage
        return redirect('http://localhost:5173');
    }
    
}
