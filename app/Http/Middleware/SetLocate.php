<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use Symfony\Component\HttpFoundation\Response;

class SetLocate
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (Session::has('lang')) {
            App::setLocale(Session::get('lang'));
        } else if ($request->hasHeader('Accept-Language')) {
            $raw = $request->header('Accept-Language');

            $locale = Str::before($raw, ',');
            $locale = str_replace('-', '_', $locale);

            $supported = ['en', 'ar'];
            if (in_array($locale, $supported)) {
                App::setLocale($locale);
            } else if (Session::has('lang')) {
                App::setLocale(Session::get('lang'));
            }
        }

        return $next($request);
    }
}
