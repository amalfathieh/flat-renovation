<?php

use App\Http\Controllers\CodeController;
use App\Http\Controllers\CompanyController;
use App\Http\Middleware\VerifiedEmail;
use App\Http\Responses\Response;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Events\Verified;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;


use App\Http\Controllers\CustomerAuthController;
use App\Http\Controllers\CustomerProfileController;
use App\Http\Controllers\SocialAuthController;

Route::get('tests', function (){
    return Auth::user();
})->middleware(['auth:sanctum', VerifiedEmail::class]);

Route::post('register' , function (Request $request){
    $user = User::create([
        'name'=> $request['name'],
        'email' => $request['email'],
        'password' => bcrypt($request['password']),
        'phone_number'=> $request['phone_number']?? null,
    ]);
    $user->assignRole('company');
    event(new Registered($user));
    return $user;
});


Route::post('/customer/register', [CustomerAuthController::class, 'register']);
Route::post('/customer/login', [CustomerAuthController::class, 'login']);
Route::post('/auth/google/token', [SocialAuthController::class, 'handleGoogleToken']);


Route::controller(CodeController::class)->group(function (){

    Route::post('verifyAccount',  'verifyAccount');
    Route::post('resendCode', 'sendCodeVerification')->middleware('throttle:6,1');

    // Send Code For Reset Password Or Resend Code
    Route::post('forgetPassword', 'sendCodeVerification');
    Route::post('checkCode', 'checkCode');
    Route::post('resetPassword', 'resetPassword');
});

Route::middleware(['auth:sanctum', 'role:customer'])->group(function () {
    Route::post('/customer/logout', [CustomerAuthController::class,'logout']);


    Route::get('/customer/profile', [CustomerProfileController::class, 'show']);
    Route::post('/customer/profile', [CustomerProfileController::class, 'update']);
    Route::post('/customer/change-password', [CustomerProfileController::class, 'changePassword']);

   Route::get('/companies', [CompanyController::class,'index']);

    Route::get('/companies/{company}/projects', [CompanyController::class,'show']);
});

