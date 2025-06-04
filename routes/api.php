<?php


use App\Http\Controllers\CustomerAuthController;

use Illuminate\Support\Facades\Route;

// 🔓 راوتات عامة بدون توكن (تسجيل دخول وتسجيل)
Route::post('/customer/register', [CustomerAuthController::class, 'register']);
Route::post('/customer/login', [CustomerAuthController::class, 'login']);

// 🔐 راوتات محمية بالتوكن ويفضل حصرها بـ role:customer
Route::middleware(['auth:sanctum', 'role:customer'])->group(function () {
    Route::post('/customer/logout', [CustomerAuthController::class,'logout']);

    // مثال لراوت محمي مخصص للزبون فقط
    Route::get('/customer/profile', function () {
        return response()->json(auth()->user());
    });
});

