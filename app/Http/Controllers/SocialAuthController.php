<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Http\Request;
use Illuminate\Support\Str;


class SocialAuthController extends Controller
{
    public function handleGoogleToken(Request $request)
    {
        $token = $request->input('token');


        $googleUser = Socialite::driver('google')->stateless()->userFromToken($token);


        $user = User::firstOrCreate(
            ['email' => $googleUser->getEmail()],
            [
                'name' => $googleUser->getName(),
                'email' => $googleUser->getEmail(),
                'google_id' => $googleUser->getId(),
                'password' => bcrypt(Str::random(16)),
            ]
        );


        $accessToken = $user->createToken('auth_token')->plainTextToken;


        return response()->json([
            'user' => $user,
            'token' => $accessToken,
        ]);
    }


}
