<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Str;




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

        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }
    
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
    
        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json(['token' => $token], 201);
    }
    public function signupWithGoogle(Request $request)
    {

        // Retrieve the necessary user details from the request
        $googleId = $request->input('googleId');
        $name = $request->input('name');
        $email = $request->input('email');
        $imageUrl = $request->input('imageUrl');

        $user = User::where('google_id', $googleId)->first();

        if (!$user) {
            // If no user with the Google ID exists, create a new user
            $user = new User();
            $user->google_id = $googleId;
            $user->name = $name;
            $user->email = $email;
            $user->image_url = $imageUrl;
            $user->save();
        }
        // Return a response indicating success or failure
        $token = $this->createToken('')->plainTextToken;
        return response()->json(['user' => $user, 'token' => $token], 201);
    }
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }
    public function handleGoogleCallback()
    {
        $user = Socialite::driver('google')->user();
        

    // Check if the user exists in the database
    $existingUser = User::where('email', $user->getEmail())->first();
    

    if ($existingUser) {
        // Log in the existing user
        Auth::login($existingUser);
    } else {
        // Create a new user
        $newUser = new User();
        $newUser->name = $user->getName();
        $newUser->email = $user->getEmail();
        $newUser->google_id = $user->getId();
        $newUser->image_url = $user->getAvatar();
        $newUser->password = bcrypt(str::random(16)); // Generate a random password
        $newUser->save();

        // Log in the new user
        Auth::login($newUser);
    }

    // Redirect the user to the desired page
    return redirect('http://localhost:5173');
    }
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            $token = $this->createToken('')->plainTextToken;
            return response()->json(['user' => $user, 'token' => $token], 200);
        }
        return response()->json(['error' => 'Unauthorized'], 401);
    }
    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return response()->json(['message' => 'Logged out.'], 200);
    }
}
