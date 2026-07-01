<?php

namespace App\Actions\Fortify;

use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Laravel\Fortify\Http\Requests\LoginRequest;

class AuthenticateUser
{
    public function __invoke(LoginRequest $loginRequest): void
    {
        $authenticated = Auth::attempt(
            $loginRequest->only('email', 'password'),
            $loginRequest->boolean('remember')
        );

        if (! $authenticated) {
            throw ValidationException::withMessages([
                'email' => __('Credenziali non valide.'),
            ]);
        }

        $user = Auth::user();

        if ($user && $user->is_deleted) {
            Auth::logout();

            throw ValidationException::withMessages([
                'email' => __('Account disattivato.'),
            ]);
        }
    }
}
