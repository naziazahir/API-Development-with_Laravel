<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register(Request $request){
        $fields = $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed'
        ]);

        $user = User::create($fields);
        $token = $user->createToken($request->name);
        return[
            'user' => $user,
            'token' => $token->plainTextToken
        ];
    }
   
    public function login(Request $request)
{
    $request->validate([
        'email' => 'required|email|exists:users,email', // Ensure email exists in 'users' table
        'password' => 'required'
    ]);

    // Find the user by email
    $user = User::where('email', $request->email)->first();

    // Check if the user exists and verify the password
    if (!$user || !Hash::check($request->password, $user->password)) {
        return response()->json([
            'message' => 'The provided credentials are invalid'
        ], 401); // Return an unauthorized status
    }

    // Create a token for the user
    $token = $user->createToken($user->name);

    return response()->json([
        'user' => $user,
        'token' => $token->plainTextToken
    ]);
}



    public function logout(Request $request){
        $request->user()->tokens()->delete();
        return[
            'message' => 'You are logged out'
        ];
    }
    

}
