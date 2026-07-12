<?php

namespace App\Enum\Customer;

enum PersonalProfileBadgeType: string
{
    case Success = 'success';
    case Warning = 'warning';
    case Danger = 'danger';
    case Secondary = 'secondary';
}
