<?php

use App\Http\Middleware\EnsureActiveCustomerProfile;
use App\Http\Middleware\EnsureActiveCustomerProfileExists;
use App\Http\Middleware\EnsureCustomerProfileOwner;
use App\Http\Middleware\EnsureCustomerProfileType;
use App\Http\Middleware\EnsurePersonalCustomerProfileCanBeCreated;
use App\Http\Middleware\RoleMiddleware;
use App\Services\System\Exception\ExceptionDecisionService;
use App\Services\System\Exception\ExceptionLoggerService;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Http\Request;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        $middleware->alias([
            'role' => RoleMiddleware::class,
            'customer.profile.exists' => EnsureActiveCustomerProfileExists::class,
            'customer.profile.active' => EnsureActiveCustomerProfile::class,
            'customer.personal.profile' => EnsurePersonalCustomerProfileCanBeCreated::class,
            'customer.profile.type' => EnsureCustomerProfileType::class,
            'customer.profile.owner' => EnsureCustomerProfileOwner::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        $exceptions->report(fn (Throwable $e) => app(ExceptionLoggerService::class)->report($e));
        $exceptions->render(fn (Throwable $e, Request $request) => app(ExceptionDecisionService::class)->handle($e, $request));
        $exceptions->shouldRenderJsonWhen(
            fn (Request $request) => $request->is('api/*'),
        );
    })->create();
