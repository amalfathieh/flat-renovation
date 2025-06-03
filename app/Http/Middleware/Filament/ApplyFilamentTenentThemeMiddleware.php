<?php

namespace App\Http\Middleware\Filament;

use Closure;
use Filament\Facades\Filament;
use Filament\Support\Facades\FilamentColor;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Symfony\Component\HttpFoundation\Response;

class ApplyFilamentTenentThemeMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $tenant = filament()->getTenant();

        if (!$tenant) {
            return $next($request);
        }

        // Set the tenant-specific logo
        Filament::getCurrentPanel()->brandLogo($tenant->getBrandLogo());
        Filament::getCurrentPanel()->brandLogoHeight('3.5rem');

        // Set the tenant-specific primary color
//        if ($colors = Arr::get($tenant->config, 'colors')) {
//            FilamentColor::register([
//                'primary' => $tenant->getPrimaryColorCode()
//            ]);
//        }

        return $next($request);
    }
}
