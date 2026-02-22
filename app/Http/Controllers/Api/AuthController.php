<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    // Register
    public function register(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6',
        ]);

        $user = User::create($validated);

        // $token = Auth::login($user);

        return response()->json([
            'message' => 'User registered successfully',
            'user' => $user,
            // 'token' => $token,
        ], 201);
    }

    // Login
    public function login(Request $request): JsonResponse
    {
        $credentials = $request->only('email', 'password');

        if (!$token = Auth::attempt($credentials)) {
            return response()->json([
                'error' => 'Invalid credentials'
            ], 401);
        }

        return response()->json([
            'message' => 'Login successful',
            'user' => Auth::user(),
            'token' => $token,
        ]);
    }

    // Logout
    public function logout(): JsonResponse
    {
        Auth::logout();

        return response()->json([
            'message' => 'Successfully logged out'
        ]);
    }

    // Get current user
    public function me(): JsonResponse
    {
        return response()->json(Auth::user());
    }

    public function index(): JsonResponse
    {
        return response()->json(Auth::user());
    }


    public function show(int $id): JsonResponse
    {
        $user = User::findOrFail($id);

        return response()->json(['data' => $user]);

    }
}