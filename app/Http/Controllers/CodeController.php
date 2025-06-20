<?php

namespace App\Http\Controllers;

use App\Http\Requests\CodeAndPasswordRequest;
use App\Http\Responses\Response;
use App\Models\User;
use App\Models\VerificationCode;
use App\Traits\CodeTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CodeController extends Controller
{
    use CodeTrait;

    public function verifyAccount(Request $request)
    {
        try {
            $request->validate([
                'code' => ['required', 'string', 'exists:verification_codes'],
            ]);

            $ver_code = VerificationCode::where('code', $request->code)->where('email', Auth::user()->email)->first();

            if (!$ver_code) {
                return Response::Error(__('strings.invalid_code'), 404);
            }
            // find user's email
            $user = User::where('email', $ver_code->email)->first();
            $token = $user->createToken("API TOKEN")->plainTextToken;
            $data = [];
            $data['user'] = $user;
            $data['token'] = $token;

            $user->update(['email_verified_at' => now()]);

            VerificationCode::where('code', $ver_code->code)->delete();
            return Response::Success($data, __('strings.created_successfully'));
        } catch (\Exception $ex) {
            return Response::Error($ex->getMessage(), $ex->getCode() ?: 404);
        }
    }

    // Send Code For Reset Password Or user forgot his password
    public function sendCodeVerification(Request $request)
    {
        try {
            $request->validate([
                'email' => ['required', 'email']
            ]);

            VerificationCode::where('email', $request->email)->delete();

            $user = User::where('email', $request->email)->first();

            if (!$user) {
                return Response::Error(__('strings.email_account_not_exist'));
            }

            //Send verification code to user
            $this->sendVerificationCode($user);

            return Response::Success(null, __('strings.code_sent_email'));
        } catch (\Exception $ex) {
            return Response::Error($ex->getMessage(), $ex->getCode() ?: 400);
        }
    }

    public function resendCode()
    {
        try {
            $user = Auth::user();
            VerificationCode::where('email', $user->email)->delete();

            $user = User::where('email', $user->email)->first();

            //Send verification code to user
            $this->sendVerificationCode($user);

            return Response::Success(null, __('strings.code_sent_email'));
        } catch (\Exception $ex) {
            return Response::Error($ex->getMessage());
        }
    }

    public function checkCode(Request $request)
    {
        try {
            $request->validate([
                'code' => ['required', 'string', 'exists:verification_codes'],
            ]);

            return Response::Success(null, __('strings.code_is_correct'));
        } catch (\Exception $ex) {
            return Response::Error($ex->getMessage());
        }
    }


    public function resetPassword(CodeAndPasswordRequest $request)
    {
        $passwordReset = VerificationCode::firstWhere('code', $request->code);

        $user = User::firstWhere('email', $passwordReset->email);

        if (!$user) {
            return Response::Error('account not exist', 404);
        }
        $user->update([
            'password' => $request->password,
        ]);
        VerificationCode::where('code', $request->code)->delete();

        $data['token'] = $user->createToken("API TOKEN")->plainTextToken;

        return Response::Success($data,  __('strings.password_reset_success'));
    }
}
