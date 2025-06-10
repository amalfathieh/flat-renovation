<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UserServices
{
    public function register(array $request): array
    {
// إنشاء المستخدم الجديد مع gender و age
        $user = User::create([
            'name'     => $request['name'],
            'email'    => $request['email'],
            'password' => Hash::make($request['password']),
            'gender'   => $request['gender'] ?? null,
            'age'      => $request['age'] ?? null,
        ]);

// تعيين دور "customer"
        $customerRole = Role::where('name', 'customer')->first();
        $user->assignRole($customerRole);

// منح صلاحيات الدور للمستخدم
        $permissions = $customerRole->permissions()->pluck('name')->toArray();
        $user->givePermissionTo($permissions);

// تحميل العلاقات
        $user->load(['roles', 'permissions']);

// إنشاء توكن
        $token = $user->createToken('auth_token')->plainTextToken;

        return [
            'user'    => $this->formatUser($user),
            'message' => 'تم إنشاء المستخدم بنجاح',
            'token'   => $token,
        ];
    }

    public function login($request): array
    {
        $user = User::where('email', $request['email'])->first();

        if (!$user) {
            return [
                'message' => 'User not found',
                'code'    => 404,
            ];
        }

        if (!Auth::attempt($request->only(['email', 'password']))) {
            return [
                'message' => 'User email & password does not match with our record.',
                'code'    => 401,
            ];
        }

        $user->load(['roles', 'permissions']);
        $token = $user->createToken("auth_token")->plainTextToken;

        return [
            'user'    => $this->formatUser($user),
            'message' => 'User logged in successfully',
            'token'   => $token,
            'code'    => 200,
        ];
    }

    public function logout(): array
    {
        if (Auth::check()) {
            Auth::user()->currentAccessToken()->delete();
            return [
                'message' => 'User logged out successfully',
                'code'    => 200,
            ];
        }

        return [
            'message' => 'Invalid token',
            'code'    => 404,
        ];
    }

    private function formatUser(User $user): array
    {
        return [
            'id'          => $user->id,
            'name'        => $user->name,
            'email'       => $user->email,
            'image'       => pathinfo($user->image, PATHINFO_BASENAME), // اسم الصورة فقط
            'age'         => $user->age,
            'gender'      => $user->gender,
            'roles'       => $user->roles->pluck('name')->toArray(),
            'permissions' => $user->permissions->pluck('name')->toArray(),
        ];
    }
}
