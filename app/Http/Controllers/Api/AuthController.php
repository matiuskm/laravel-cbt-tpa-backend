<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:55',
            'email' => 'email|required|unique:users',
            'password' => 'required|confirmed'
        ]);

        $validatedData['password'] = Hash::make($validatedData['password']);
        $validatedData['roles'] = 'user';
        $user = User::create($validatedData);

        $token = $user->createToken('auth_token')->plainTextToken;
        return response()->json([
            'access_token' => $token,
            'user' => $user,
        ], 201);
    }

    public function login(Request $request)
    {
        $validatedData = $request->validate([
            'email' => 'email|required',
            'password' => 'required'
        ]);

        $user = User::where('email', $validatedData['email'])->first();

        if (!$user || !Hash::check($validatedData['password'], $user->password)) {
            return response()->json([
                'message' => 'Invalid email and/or password'
            ], 401);
        }

        $token = $user->createToken('auth_token')->plainTextToken;
        $user->last_login = \Carbon\Carbon::now();
        $user->save();
        return response()->json([
            'access_token' => $token,
            'user' => $user,
        ]);
    }

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return response()->json([
            'message' => 'Logged out'
        ]);
    }

    public function refresh(Request $request)
    {
        return response()->json([
            'message' => 'Refresh'
        ]);
    }

    public function me(Request $request)
    {
        return response()->json([
            'message' => 'Me'
        ]);
    }
}
