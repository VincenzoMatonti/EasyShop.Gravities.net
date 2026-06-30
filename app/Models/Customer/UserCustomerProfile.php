<?php

namespace App\Models\Customer;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;
use App\Enum\RoleCustomerProfile;

class UserCustomerProfile extends Model
{
    protected $table = 'user_customer_profile';

    protected $casts = [
        'role' => RoleCustomerProfile::class,
        'is_default' => 'boolean',
    ];
}
