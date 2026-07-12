<?php

namespace App\Queries\Customer;

use App\Models\Identity\User;
use App\ViewModels\Customer\CustomerEntryViewModel;

class GetCustomerEntryStateQuery
{
    public function execute(User $user): CustomerEntryViewModel
    {
        $profiles = $user->getActiveCustomerProfiles();

        return new CustomerEntryViewModel(
            hasProfiles: $user->hasActiveCustomerProfiles(),

            hasDefaultProfile: $user->hasDefaultCustomerProfile(),

            profilesCount: $user->getActiveCustomerProfiles()->count(),

            hasPersonalProfile: $user->hasPersonalCustomerProfile(),

            defaultProfile: $user->getDefaultCustomerProfile(),
        );
    }
}
