<?php

namespace App\Enum\Customer;

enum CustomerProfileType: int
{
    case personal = 1;
    case business = 2;

    public static function tryFromName(string $name): ?self
    {
        return match ($name) {

            self::personal->name => self::personal,

            self::business->name => self::business,

            default => null,
        };
    }
}
