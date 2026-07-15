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
        return DB::transaction(function () use ($data) {

            $profile = $this->customerProfileDomainService->createPersonalProfile($data);

            DB::afterCommit(function () use ($profile, $data) {
                event(new PersonalCustomerProfileCreated(
                    profileId: $profile->id,
                    userId: $data->user->id,
                ));
            });

            return $profile;
        });
    }
}
