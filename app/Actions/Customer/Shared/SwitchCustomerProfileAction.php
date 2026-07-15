<?php

namespace App\Actions\Customer\Shared;

use App\Dtos\Customer\Shared\SwitchCustomerProfileData;
use App\Services\Customer\CustomerContextService;

class SwitchCustomerProfileAction
{
    public function __construct(private CustomerContextService $context) {}

    public function execute(SwitchCustomerProfileData $data): void
    {
        if (!$data->user->hasCustomerProfile($data->customerProfileId)) {
            abort(403);
        }

        $this->context->setById($data->customerProfileId);
    }
}
