<?php



use App\Http\Controllers\CustomerAuthController;


use App\Http\Controllers\CustomerProfileController;
use App\Http\Controllers\SocialAuthController;
use Illuminate\Support\Facades\Route;


Route::post('/customer/register', [CustomerAuthController::class, 'register']);
Route::post('/customer/login', [CustomerAuthController::class, 'login']);
Route::post('/auth/google/token', [SocialAuthController::class, 'handleGoogleToken']);



Route::middleware(['auth:sanctum', 'role:customer'])->group(function () {
    Route::post('/customer/logout', [CustomerAuthController::class,'logout']);


    Route::get('/customer/profile', [CustomerProfileController::class, 'show']);
    Route::post('/customer/profile', [CustomerProfileController::class, 'update']);
    Route::post('/customer/change-password', [CustomerProfileController::class, 'changePassword']);



});

