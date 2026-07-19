<?php

namespace App\Http\Middleware;

use App\Enum\Customer\CustomerProfileType;
use App\Services\Customer\CustomerContextService;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureCustomerProfileType
{
    public function __construct(
        private readonly CustomerContextService $context
    ) {}

    public function handle(Request $request, Closure $next, string $type): Response
    {
        $profile = $this->context->current();

        if (! $profile) {
            return redirect()->route('customer.profile.select');
        }
        $expectedType = CustomerProfileType::tryFromName($type);

        if (! $expectedType) {
            abort(500, 'Invalid customer profile type');
        }

        if ($profile->type !== $expectedType) {
            abort(403);
        }

        return $next($request);
    }
}
