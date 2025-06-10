<?php

namespace App\Services\Auth
;

use App\Models\User;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class CustomerAuthService implements CustomerAuthServiceInterface
{
    public function register(Request $request): array
    {
        $validated = $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6|confirmed',
            'phone' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'age' => 'nullable|integer|min:1',
            'gender' => 'nullable|in:male,female',
        ]);

        $imagePath = $request->hasFile('image')
            ? $request->file('image')->store('users', 'public')
            : null;

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => bcrypt($validated['password']),
            'email_verified_at' => now(),
        ]);

        $user->assignRole('customer');

        // إنشاء ملف تعريف المستخدم
        $user->customerProfile()->create([
            'phone' => $validated['phone'] ?? null,
            'image' => $imagePath,
            'age' => $validated['age'] ?? null,
            'gender' => $validated['gender'] ?? null,
        ]);

        $token = $user->createToken('mobile')->plainTextToken;

        return [
            'user' => $this->formatUser($user),
            'token' => $token,
        ];
    }

    public function login(Request $request): array
    {
        if (!Auth::attempt($request->only('email', 'password'))) {
            throw new \Exception('Incorrect data', 401);
        }

        $user = Auth::user();

        if (!$user->hasRole('customer')) {
            throw new \Exception('You do not have permission to log in as a mobile user.', 403);
        }

        $token = $user->createToken('mobile')->plainTextToken;

        return [
            'user' => $this->formatUser($user),
            'token' => $token,
        ];
    }

    public function logout(Request $request): void
    {
        $request->user()->currentAccessToken()->delete();
    }

    private function formatUser(User $user): array
    {
        $profile = $user->customerProfile;
        return [
            'id' => $user->id,
            'name' => $user->name,
            'email' => $user->email,
            'phone' => $profile->phone ?? null,
            'image' => $profile->image ? basename($profile->image) : null,
            'age' => $profile->age ?? null,
            'gender' => $profile->gender ?? null,
            'role' => $user->getRoleNames(),
        ];
    }
}
