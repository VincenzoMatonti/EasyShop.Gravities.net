<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Services\Customer\CustomerContextService;
use Symfony\Component\HttpFoundation\Response;

class EnsureCustomerProfileOwner
{
    public function __construct(
        private readonly CustomerContextService $context,
    ) {}


    public function handle(Request $request, Closure $next): Response
    {
        $profile = $this->context->current();

        if (!$profile) {
            abort(403);
        }

        $user = $request->user();

        if (!$profile->users()->whereKey($user->id)->exists()) {
            abort(403);
        }

        return $next($request);
    }
}
