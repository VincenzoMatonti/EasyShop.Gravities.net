<?php

namespace App\Dtos\Customer;

use App\Models\Identity\User;

class SwitchCustomerProfileData
{
    public function __construct(

        public readonly User $user,
        
        public readonly int $customerProfileId,
    ) {}
}
