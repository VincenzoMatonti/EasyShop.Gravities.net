<?php

namespace App\Http\Middleware;

use App\Models\Identity\User;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class EnsureActiveCustomerProfileExists
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        /** @var User $user */
        $user = Auth::user();

        if (! $user->hasActiveCustomerProfiles()) {
            return redirect()->route('customer.profile.create');
        }

        return $next($request);
    }
}
