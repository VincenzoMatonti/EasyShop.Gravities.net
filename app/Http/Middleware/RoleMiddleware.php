<?php

namespace App\Http\Middleware;

use App\Models\Identity\User;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next, string ...$roles): Response
    {
        /** @var User $user */
        $user = Auth::user();

        if (! $user->hasAnyRole($roles)) {
            return redirect()->route($user->homeRoute());
        }

        return $next($request);
    }
}
