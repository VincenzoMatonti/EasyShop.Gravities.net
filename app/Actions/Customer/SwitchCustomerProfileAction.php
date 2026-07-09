<?php

namespace App\Actions\Customer;

use App\Models\Identity\User;
use App\Services\Customer\CustomerContextService;

class SwitchCustomerProfileAction
{
    public function __construct(private CustomerContextService $context) {}

    public function execute(User $user,int $customerProfileId): void {

        if (!$user->hasCustomerProfile($customerProfileId)) {
            abort(403);
        }

        $this->context->setById($customerProfileId);
    }
}
