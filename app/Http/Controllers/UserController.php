<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function signup(Request $request)
    {
        // Perform form validation on $request->input() data if needed
        
        // Create a new user in the database
        $user = new User();
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->password = bcrypt($request->input('password'));
        $user->save();
        
        // Return a response indicating success or failure
        return response()->json(['message' => 'User created successfully'], 201);
    }
    public function signupWithGoogle(Request $request)
    {
        // Retrieve the necessary user details from the request
        $googleId = $request->input('googleId');
        $name = $request->input('name');
        $email = $request->input('email');
        $imageUrl = $request->input('imageUrl');

        // Create a new user in the database with the retrieved data
        $user = new User();
        $user->google_id = $googleId;
        $user->name = $name;
        $user->email = $email;
        $user->image_url = $imageUrl;
        $user->save();

        // Return a response indicating success or failure
        return response()->json(['message' => 'User created successfully'], 201);
    }
}
