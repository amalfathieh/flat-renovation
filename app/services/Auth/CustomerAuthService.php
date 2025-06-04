<?php

namespace App\Services\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CustomerAuthService implements CustomerAuthServiceInterface
{
    public function register(Request $request): array
    {
        $validated = $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6|confirmed', // مضاف: confirmed
            'phone' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'age' => 'nullable|integer|min:1',
            'gender' => 'nullable|in:male,female',
        ]);

        $imagePath = null;

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('users', 'public');
        }

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => bcrypt($validated['password']),
            'phone' => $validated['phone'] ?? null,
            'image' => $imagePath,
            'age' => $validated['age'] ?? null,
            'gender' => $validated['gender'] ?? null,
        ]);

        $user->assignRole('customer');

        $token = $user->createToken('mobile')->plainTextToken;

        return [
            'user' => $user,
            'token' => $token,
        ];
    }

    public function login(Request $request): array
    {
        if (!Auth::attempt($request->only('email', 'password'))) {
            throw new \Exception('بيانات خاطئة', 401);
        }

        $user = Auth::user();

        if (!$user->hasRole('customer')) {
            throw new \Exception('ليس لديك صلاحية الدخول كمستخدم موبايل', 403);
        }


        $token = $user->createToken('mobile')->plainTextToken;

        return [
            'user' => $user,
            'token' => $token,
        ];
    }

    public function logout(Request $request): void
    {
        $request->user()->currentAccessToken()->delete();
    }
}
