<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProjectController;
use App\Http\Responses\Response;
use App\Models\User;

use Filament\Facades\Filament;
use Illuminate\Support\Facades\Route;
use App\Models\Company;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\Events\Verified;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Support\Facades\Session;

Route::get('/bb', function () {
//    return "kk";
    return view('test22');
});

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

Route::get('/company', function () {
    return view('company-landing');
});
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

/*
Route::get(/custom-create-project, function () {
    $company = Filament::getTenant();

    if (!$company || !$company->activeSubscription) {
        session()->flash(error, ‘لا يمكنك إنشاء مشروع لأنك غير مشترك بأي باقة حالياً.);
        return redirect()->route(filament.company.resources.projects.index, [tenant => $company->id]);
    }

    $subscription = $company->activeSubscription;
    $limit = $subscription->subscriptionPlan->project_limit;
    $used = $subscription->used_projects;

    if ($used >= $limit) {
        session()->flash(error, ‘لقد استهلكت الحد الأقصى من المشاريع المسموح بها في باقتك.);
        return redirect()->route(filament.company.resources.projects.index, [tenant => $company->id]);
    }

    // OK: redirect to create page
    return redirect()->route(filament.company.resources.projects.create, [tenant => $company->id]);
})->name(custom.create.project);*/




//Route::get('/custom-create-project', function () {
//    $company = Filament::getTenant();
////    $company = Auth::user()->company;
//
//    dd($company);
//
//    if (!$company || !$company->activeSubscription) {
//        Session::flash('error', '‘لا يمكنك إنشاء مشروع لأنك غير مشترك بأي باقة حالياً.');
//        return redirect()->route('filament.company.resources.projects.index', ['tenant' => $company->id]);
//    }
//
//    $subscription = $company->activeSubscription;
//    $limit = $subscription->subscriptionPlan->project_limit;
//    $used = $subscription->used_projects;
//
//    if ($used >= $limit) {
//        Session::flash('error', '‘لقد استهلكت الحد الأقصى من المشاريع المسموح بها في باقتك.');
//        return redirect()->route('filament.company.resources.projects.index', ['tenant' => $company->id]);
//    }
//
//    // OK, redirect to normal create page
//    return redirect()->route('filament.company.resources.projects.create', ['tenant' => $company->id]);
//})->name('custom.create.project');

Route::group(['middleware' => ['auth', \App\Http\Middleware\CheckCompanySubscription::class]], function () {
    Route::resource('projects', ProjectController::class);
});

require __DIR__.'/auth.php';
