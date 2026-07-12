<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\Identity\User;

class EnsurePersonalCustomerProfileCanBeCreated
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        /** @var User $user */
        $user = $request->user();

        if ($user->hasPersonalCustomerProfile()) {
            return redirect()->route('customer.index')->with('error', 'Hai già un profilo personale.');
        }

        return $next($request);
    }
}
