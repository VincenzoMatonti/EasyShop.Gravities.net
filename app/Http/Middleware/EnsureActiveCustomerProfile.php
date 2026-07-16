<?php

namespace App\Http\Middleware;

use App\Models\Identity\User;
use App\Services\Customer\CustomerContextService;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class EnsureActiveCustomerProfile
{
    public function __construct(
        private readonly CustomerContextService $customerContext,
    ) {
    }

    public function handle(Request $request, Closure $next): Response
    {
        /** @var User $user */
        $user = Auth::user();

        if ($this->customerContext->has($user)) {
            return $next($request);
        }

        $this->customerContext->clear();

        if ($this->customerContext->setDefault($user)) {
            return $next($request);
        }

        return redirect()->route('customer.profile.select');
    }
}