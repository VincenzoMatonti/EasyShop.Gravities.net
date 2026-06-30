<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;
use App\Models\Identity\User;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next, string ...$roles): Response
    {
        $user = Auth::user();

        if (!$user instanceof User) {
            abort(401);
        }

        $roles = explode(',', ...$roles);

        if (!$user->hasAnyRole($roles)) {
            abort(403);
        }
        return $next($request);
    }
}
