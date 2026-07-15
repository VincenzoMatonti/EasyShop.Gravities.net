<?php

use Illuminate\Http\Request;
use Illuminate\Foundation\Application;
use App\Http\Middleware\RoleMiddleware;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use App\Http\Middleware\EnsureCustomerProfileType;
use App\Http\Middleware\EnsureCustomerProfileOwner;
use App\Http\Middleware\EnsureActiveCustomerProfile;
use App\Http\Middleware\EnsureActiveCustomerProfileExists;
use App\Http\Middleware\EnsurePersonalCustomerProfileCanBeCreated;




return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        commands: __DIR__ . '/../routes/console.php',
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
        $exceptions->shouldRenderJsonWhen(
            fn(Request $request) => $request->is('api/*'),
        );
    })->create();
