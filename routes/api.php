<?php

use App\Http\Controllers\CodeController;
use App\Http\Controllers\CompanyController;

use App\Http\Controllers\ObjectionController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\ProjectStageController;
use App\Http\Controllers\SearchController;
use App\Http\Middleware\VerifiedEmail;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use App\Http\Controllers\CompanyServiceController;
use App\Http\Controllers\OrderController;
use App\Http\Responses\Response;
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

    Route::get('/companies', [CompanyController::class,'index']);
    Route::get('/companies/{company}/projects', [CompanyController::class,'show']);


//    Route::get('/companies', [CompanyController::class,'index']);
//    Route::get('/companies/{company}/projects', [CompanyController::class,'show']);


});

Route::middleware(['auth:sanctum', 'role:customer'])->group(function () {


    Route::controller(ProjectController::class)->prefix('projects')->group(function (){

        Route::get('myProject', 'getMyProjects');

        Route::get('allPublishProjects', 'getAllPublishProjects')->withoutMiddleware('role:customer');
    });

    Route::controller(ProjectStageController::class)->group(function (){
        Route::get('projectStages/{id}', 'getProjectStages');
//        Route::get('serviceTypes/{id}', 'getServiceTypes');
//        Route::post('editServiceType/{id}', 'editServiceType');
    });

    Route::controller(ObjectionController::class)->prefix('objections')->group(function (){
        Route::post('create/{id}', 'create');
        Route::get('stageObjections/{id}', 'getObjections');
    });


    Route::post('/customer/logout', [CustomerAuthController::class,'logout']);


    Route::get('/customer/getprofile', [CustomerProfileController::class, 'show']);
    Route::post('/customer/profile', [CustomerProfileController::class, 'update']);
    Route::post('/customer/change-password', [CustomerProfileController::class, 'changePassword']);

   Route::get('/companies', [CompanyController::class,'index']);

    Route::get('/companies/{company}/projects', [CompanyController::class,'show']);
    Route::get('/companies/CompanyPublishProjects/{id}', [CompanyController::class,'getCompanyPublishProjects'])->withoutMiddleware('role:customer');

    Route::post('/companies/search', [SearchController::class, 'search']);

    Route::get('/companies/{company}/projects', [CompanyController::class,'show']);





    //safa

    Route::get('/company_services/{id}',[CompanyServiceController::class,'index']);

    Route::post('/services/questions', [CompanyServiceController::class, 'getQuestionsForServices']);

    Route::post('/survey/calculate-cost', [CompanyServiceController::class, 'calculateSurveyCost']);



//Strip

    Route::post('/payment/create-payment-intent', [OrderController::class, 'createPaymentIntent']);
    Route::post('/Add_Order', [OrderController::class, 'storeOrder']);

    //  rout for test
    Route::post('/checkout-session', [OrderController::class, 'createCheckoutSession']);




    Route::get('/companies/{company}/projects', [CompanyController::class,'show']);
    Route::post('/companies/search', [SearchController::class, 'search']);


});





