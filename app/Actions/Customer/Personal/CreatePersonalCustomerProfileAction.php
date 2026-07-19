<?php

namespace App\Actions\Customer\Personal;

use App\Dtos\Customer\Personal\CreatePersonalCustomerProfileData;
use App\Events\Customer\Personal\PersonalCustomerProfileCreated;
use App\Exceptions\Customer\Personal\PersonalCustomerProfileAlreadyExistsException;
use App\Exceptions\Customer\Personal\PersonalProfileCreationException;
use App\Models\Customer\CustomerProfile;
use App\Rules\Customer\Personal\CustomerPersonalProfileDomainService;
use Illuminate\Support\Facades\DB;
use Throwable;

class CreatePersonalCustomerProfileAction
{
    public function __construct(
        private readonly CustomerPersonalProfileDomainService $customerProfileDomainService
    ) {}

    public function execute(CreatePersonalCustomerProfileData $data): CustomerProfile
    {
        try {
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
        } catch (PersonalCustomerProfileAlreadyExistsException $e) {
            throw $e;
        } catch (Throwable $e) {
            throw new PersonalProfileCreationException(
                previous: $e
            );
        }
    }
}
