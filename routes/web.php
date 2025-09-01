<?php

use App\Http\Controllers\DeviceTokenController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\SubscriptionController;
use App\Http\Responses\Response;
use App\Models\CompanySubscription;
use App\Models\User;

use App\Notifications\SendNotification;
use Filament\Facades\Filament;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Route;
use App\Models\Company;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\Events\Verified;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Notification;


Route::post('device-token', [DeviceTokenController::class,'store'])->middleware('auth');

Route::get('checkout', [\App\Http\Controllers\NotificationController::class,'checkout']);

Route::get('rr', \App\Http\Controllers\DownloadInvoiceController::class);
Route::get('/bb/{id}', function ($id) {

    $p = \App\Models\SubscriptionPlan::find($id)->first();

    return view('test22',[
        'plan' => $p
    ]);
    return view('test22', $p);
})->name('payment.create');

//Route::get('/payment/create/{plan}', [SubscriptionController::class, 'create'])->name('payment.create');
Route::post('subscription/confirm/{plan}', [SubscriptionController::class, 'confirm'])->name('subscription.confirm');


Route::get('/testWeb', function () {
    $user= Auth::user();
    return $user;
});
Route::get('/verify-email/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill(); // تؤكد البريد
    event(new Verified(User::query()->find($request->route('id'))));
    return Response::Success(null, 'Email Verified Successfully');
})->middleware(['auth:sanctum', 'signed'])->name('verification.verify');

Route::post('/email/verification-notification', function (Illuminate\Http\Request $request) {
    $request->user()->sendEmailVerificationNotification();
    return back()->with('message', 'تم إرسال الرابط.');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::group(['middleware' => ['auth', \App\Http\Middleware\CheckCompanySubscription::class]], function () {
    Route::resource('projects', ProjectController::class);
});

require __DIR__.'/auth.php';
