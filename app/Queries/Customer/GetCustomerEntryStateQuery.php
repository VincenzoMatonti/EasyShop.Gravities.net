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
            hasProfiles: $profiles->isNotEmpty(),
            hasDefaultProfile: $profiles->contains(fn($profile) => $profile->pivot->is_default),
            profilesCount: $profiles->count(),
        );
    }
}
