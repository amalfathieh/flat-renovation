<?php

namespace App\Http\Middleware;
use App\Http\Responses\Response;
use Closure;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Http\Request;

class VerifiedEmail
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {
        if (!$request->user() || ($request->user() instanceof  MustVerifyEmail && ! $request->user()->hasVerifiedEmail())){
            return Response::Error( __('strings.account_not_verified'));
        }
        return $next($request);
    }
}
