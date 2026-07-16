<?php

namespace App\Enum\Customer;

enum RoleCustomerProfile: int
{
    case owner = 1;
    case buyer = 2;
    case accountant = 3;
}
