<?php

namespace App\Enum\Customer;

enum LabelPhone: int
{
    // PERSONALI
    case Mobile = 1;
    case Home = 2;

    // BUSINESS
    case Office = 10;
    case Support = 11;
    case Sales = 12;
    case Billing = 13;
    case Warehouse = 14;

    // GENERICO
    case Other = 99;
}
