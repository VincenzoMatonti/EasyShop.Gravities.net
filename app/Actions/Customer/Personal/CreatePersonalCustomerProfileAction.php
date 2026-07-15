<?php

namespace App\Actions\Customer\Personal;

use App\Dtos\Customer\Personal\CreatePersonalCustomerProfileData;
use App\DomainServices\Customer\Personal\CustomerPersonalProfileDomainService;
use App\Models\Customer\CustomerProfile;
use Illuminate\Support\Facades\DB;

class CreatePersonalCustomerProfileAction
{
    /**
     * Create a new class instance.
     */
     public function __construct(
         private readonly CustomerPersonalProfileDomainService $customerProfileDomainService
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
