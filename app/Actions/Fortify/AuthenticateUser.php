<?php

namespace App\Actions\Fortify;

use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class AuthenticateUser
{
    public function __invoke(array $input): void
    {
        $authenticated = Auth::attempt([
            'email' => $input['email'],
            'password' => $input['password'],
        ], $input['remember'] ?? false);

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
