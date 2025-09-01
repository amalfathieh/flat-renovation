<?php

use App\Http\Responses\Response;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->append(\App\Http\Middleware\SetLocate::class);
    })
    ->withExceptions(
        function (Exceptions $exceptions) {
            $exceptions->render(function (AccessDeniedHttpException $e, $request) {
                    return Response::Error('You do not have the required authorization.',
                403);
            });
    })
    ->withBindings([
        Illuminate\Contracts\Http\Kernel::class => App\Http\Kernel::class,
    ])
    ->withSchedule(function (Schedule $schedule) {
        $schedule->command('subscriptions:deactivate-expired')->daily();
        $schedule->command('subscriptions:notify-expiring')->twiceDaily();
    })
    ->withCommands([
        \App\Console\Commands\DeactivateExpiredSubscriptions::class,
    ])
    ->create();
