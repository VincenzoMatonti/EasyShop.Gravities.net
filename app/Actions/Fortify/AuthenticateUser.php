<?php

namespace App\Actions\Fortify;

use App\Models\Identity\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Laravel\Fortify\Http\Requests\LoginRequest;

class AuthenticateUser
{
    public function __invoke(LoginRequest $loginRequest): ?User
    {
        $user = User::active()->where('email', $loginRequest->email)->first();

        if (!$user) {
            return null;
        }

        if (!Hash::check($loginRequest->password, $user->password)) {
            return null;
        }

        return $user;
    }
}
