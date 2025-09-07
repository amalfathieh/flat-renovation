<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckBanned
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */


    public function handle(Request $request, Closure $next): Response
    {
        $user = auth()->user();

        if ($user) {
            // إذا المستخدم محظور
            if ($user->banned_until && now()->lessThan($user->banned_until)) {
                return $this->logoutWithMessage($user->banned_until, 'user');
            }

            // إذا الشركة محظورة
            if ($user->company && $user->company->banned_until && now()->lessThan($user->company->banned_until)) {
                return $this->logoutWithMessage($user->company->banned_until, 'company');
            }
        }

        return $next($request);
    }

    protected function logoutWithMessage($banned_until, $type = 'user')
    {
        $banned_days = now()->diffInDays($banned_until);
        auth()->logout();

        $message = ucfirst($type) . ' account has been suspended for ' . $banned_days . ' ' . \Illuminate\Support\Str::plural('day', $banned_days) . '.';

        return redirect()->route('login')->with('message', $message);
    }

}
