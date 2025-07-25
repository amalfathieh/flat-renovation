<?php

namespace App\Services\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Traits\CodeTrait;

class CustomerAuthService implements CustomerAuthServiceInterface
{
    use CodeTrait;

    public function register($request): array
    {

        $imagePath = null;
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $avatarName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images'), $avatarName);
            $imagePath = 'images/' . $avatarName;
        }


        $user = User::create([
            'name'     => $request['name'],
            'email'    => $request['email'],
            'password' => bcrypt($request['password']),
        ]);


        $user->assignRole('customer');



        $user->customerProfile()->create([
            'phone'  => $request['phone'] ?? null,
            'image'  => $imagePath,
            'age'    => $request['age'] ?? null,
            'gender' => $request['gender'] ?? null,
        ]);


        $token = $user->createToken('mobile')->plainTextToken;


        $this->sendVerificationCode($user);

        return [
            'user'  => $this->formatUser($user),
            'token' => $token,
        ];
    }

    public function login(Request $request): array
    {

        if (!Auth::attempt($request->only('email', 'password'))) {
            throw new \Exception(__('strings.email_password_mismatch'), 401);
        }

        $user = Auth::user();


        if (!$user->hasRole('customer')) {
            throw new \Exception(__('strings.no_mobile_permission'), 403);
        }

        $token = $user->createToken('mobile')->plainTextToken;

        return [
            'user'  => $this->formatUser($user),
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
            'id'                => $user->id,
            'name'              => $user->name,
            'email'             => $user->email,
            'phone'             => $profile->phone ?? null,
            'image'             => $profile->image  ?? null,
            'age'               => $profile->age ?? null,
            'gender'            => $profile->gender ?? null,
            'role'              => $user->getRoleNames(),
            'created_at'        => $user->created_at,
            'email_verified_at' => $user->email_verified_at,
        ];
    }
}

