<?php

namespace App\Models\Customer;

use Illuminate\Database\Eloquent\Relations\Pivot;
use App\Enum\Customer\RoleCustomerProfile;

class UserCustomerProfile extends  Pivot
{
    protected $table = 'user_customer_profile';

    protected $casts = [
        'role' => RoleCustomerProfile::class,
        'is_default' => 'boolean',
    ];
}
