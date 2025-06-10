<?php

namespace App\Providers;
use App\Services\Auth\CustomerAuthServiceInterface;
use App\Services\Auth\CustomerAuthService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register()
    {
        $this->app->bind(CustomerAuthServiceInterface::class, CustomerAuthService::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
