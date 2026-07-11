<?php

namespace App\Actions\Customer;

use App\Dtos\Customer\CreatePersonalCustomerProfileData;
use App\DomainServices\Customer\CustomerProfileDomainService;
use App\Models\Customer\CustomerProfile;
use Illuminate\Support\Facades\DB;

class CreatePersonalCustomerProfileAction
{
    /**
     * Create a new class instance.
     */
     public function __construct(
         private readonly CustomerProfileDomainService $customerProfileDomainService
    ) {
    }

    public function execute(CreatePersonalCustomerProfileData $data): CustomerProfile
    {
        return DB::transaction(function () use ($data) {

            $profile = $this->customerProfileDomainService->createPersonalProfile($data);

            // event(new PersonalCustomerProfileCreated(
            //     user: $data->user,
            //     profile: $profile,
            // ));

            return $profile;
        });
    }
}
