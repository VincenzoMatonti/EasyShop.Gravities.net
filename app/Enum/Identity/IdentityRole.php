<?php

namespace App\Enum\Identity;

enum IdentityRole: string
{
    case ADMIN = 'admin';
    case MANAGER = 'manager';
    case CUSTOMER = 'customer';
}
