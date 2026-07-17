<?php

namespace App\Models\Customer;

use App\Enum\Customer\RoleCustomerProfile;
use Illuminate\Database\Eloquent\Relations\Pivot;

class UserCustomerProfile extends Pivot
{
    protected $table = 'user_customer_profile';

    protected $casts = [
        'role' => RoleCustomerProfile::class,
        'is_default' => 'boolean',
    ];
}
