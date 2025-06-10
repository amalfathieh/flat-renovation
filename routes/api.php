<?php

use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Events\Verified;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('tests', function (){
    return Auth::user();
    $user = User::query()->findOrFail(3);
//    return $user->company()->whereKey($tenant)->exists();
    return $user->company;
    return $user;
});
Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

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


Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill(); // تؤكد البريد
    event(new Verified(User::query()->find($request->route('id'))));
    return response()->json([
        'data' =>true,
        'message' => 'Email Verified Successfully',
    ], 200);
})->middleware(['auth:sanctum', 'signed'])->name('verification.verify');

Route::post('/email/verification-notification', function (Illuminate\Http\Request $request) {
    $request->user()->sendEmailVerificationNotification();
    return response()->json([
        'data' =>true,
        'message' => 'Verification link sent',
    ], 200);
})->middleware(['auth:sanctum', 'throttle:6,1'])->name('verification.send');




