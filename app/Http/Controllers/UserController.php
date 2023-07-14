<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;




class UserController extends Controller
{
    public function signup(Request $request)
    {
        // Perform form validation on $request->input() data if needed
        
        /* Create a new user in the database
        $user = new User();
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->password = bcrypt($request->input('password'));
        $user->save();
        $id = $user->id;
        return response()->json(['user' => $user], 201);*/

        $validatedData = $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
        ]);
    
        $user = User::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'password' => Hash::make($validatedData['password']),
        ]);
    
        return response()->json(['user' => $user], 201);

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
        return response()->json(['user' => $user], 201);
    }
    public function loginn(Request $request)
    {
        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            $token = $this->createToken('MyApp')->plainTextToken;
            return response()->json(['user' => $user, 'token' => $token], 200);
        }
        return response()->json(['error' => 'Unauthorized'], 401);
    }
}
