<?php

namespace App\Actions\Customer\Personal;

use Illuminate\Support\Facades\DB;
use App\Models\Customer\CustomerProfile;
use App\Events\Customer\Personal\PersonalCustomerProfileCreated;
use App\Dtos\Customer\Personal\CreatePersonalCustomerProfileData;
use App\DomainServices\Customer\Personal\CustomerPersonalProfileDomainService;

class CreatePersonalCustomerProfileAction
{
    public function __construct(
        private readonly CustomerPersonalProfileDomainService $customerProfileDomainService
    ) {}

    public function execute(CreatePersonalCustomerProfileData $data): CustomerProfile
    {
        $profile =  DB::transaction(function () use ($data) {
            return $this->customerProfileDomainService->createPersonalProfile($data);
        });

        PersonalCustomerProfileCreated::dispatch(
            profileId: $profile->id
        );

        return $profile;
    }
}
