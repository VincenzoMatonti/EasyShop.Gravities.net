<?php

namespace App\Enum;

enum RoleCustomerProfile: int
{
    case owner = 1;
    case buyer = 2;
    case accountant = 3;
}
