<?php

namespace App\Dtos\Customer;

use App\Models\Identity\User;
use Carbon\Carbon;

class CreatePersonalCustomerProfileData
{
    public function __construct(

        public readonly User $user,

        public readonly string $name,

        public readonly string $surname,

        public readonly ?string $phonePrefix,

        public readonly ?string $phone,

        public readonly ?string $taxCode,

        public readonly ?Carbon $birthDate,
    ) {}
}
