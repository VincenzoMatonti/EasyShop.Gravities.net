<?php

namespace App\Queries\Customer\Shared\EntryState;

use App\Models\Identity\User;
use App\ViewModels\Customer\Shared\EntryState\CustomerEntryViewModel;

class GetCustomerEntryStateQuery
{
    public function execute(User $user): CustomerEntryViewModel
    {
        return new CustomerEntryViewModel(
            hasProfiles: $user->hasActiveCustomerProfiles(),

            hasDefaultProfile: $user->hasDefaultCustomerProfile(),

            profilesCount: $user->getActiveCustomerProfiles()->count(),

            hasPersonalProfile: $user->hasPersonalCustomerProfile(),

            defaultProfile: $user->getDefaultCustomerProfile(),
        );
    }
}
