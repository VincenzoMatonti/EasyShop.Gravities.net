<?php

namespace App\Queries\Customer\Shared\SelectState;

use App\Models\Identity\User;
use Illuminate\Database\Eloquent\Collection;

class GetActiveCustomerProfilesQuery
{
    public function execute(User $user): Collection
    {
        return $user->getActiveCustomerProfiles();
    }
}
