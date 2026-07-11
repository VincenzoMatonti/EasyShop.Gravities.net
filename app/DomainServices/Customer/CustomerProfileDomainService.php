<?php

namespace App\DomainServices\Customer;

use App\Dtos\Customer\CreatePersonalCustomerProfileData;
use App\Enum\Customer\LabelEmail;
use App\Enum\Customer\LabelPhone;
use App\Models\Customer\CustomerProfile;

class CustomerProfileDomainService
{
    public function createPersonalProfile(CreatePersonalCustomerProfileData $data): CustomerProfile
    {
        $profile = CustomerProfile::createPersonal($data->name, $data->surname,);

        $data->user->attachCustomerProfile($profile, !$data->user->hasDefaultCustomerProfile());

        $this->populateUserInformation($data);

        return $profile;
    }

    private function populateUserInformation(CreatePersonalCustomerProfileData $data): void
    {
        if (!$data->user->hasUserInfo()) {
            $data->user->createUserInfo([
                'name'       => $data->name,
                'surname'    => $data->surname,
                'tax_code'   => $data->taxCode,
                'birth_date' => $data->birthDate,
            ]);
        }

        $data->user->createPrimaryEmail($data->user->email, LabelEmail::Personal,);

        if ($data->phone) {
            $data->user->createPrimaryPhone($data->phonePrefix, $data->phone, LabelPhone::Personal,);
        }
    }
}
