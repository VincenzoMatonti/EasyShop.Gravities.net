<?php

namespace App\Actions\Fortify;

use App\Enum\Identity\IdentityRole;
use App\Models\Identity\Role;
use App\Models\Identity\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;
use Laravel\Fortify\Contracts\CreatesNewUsers;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    /**
     * Validate and create a newly registered user.
     *
     * @param  array<string, string>  $input
     *
     * @throws ValidationException
     */
    public function create(array $input): User
    {
        Validator::make($input, [
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique(User::class),
            ],
            'password' => $this->passwordRules(),
        ])->validate();

        $user = User::create([
            'email' => $input['email'],
            'password' => $input['password'],
        ]);

        $role = Role::where('name', IdentityRole::CUSTOMER->value)->firstOrFail();

        $user->roles()->syncWithoutDetaching([$role->id]);

        event(new Registered($user));

        return $user;
    }
}
