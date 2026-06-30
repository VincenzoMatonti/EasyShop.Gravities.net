<?php

namespace App\Enum\Customer;

enum LabelAddress: int
{
    // PERSONALI
    case Home = 1;
    case Shipping = 2;
    case Billing = 3;

    // AZIENDALI
    case Office = 10;
    case Legal = 11;
    case Warehouse = 12;
    case Operational = 13;

    // GENERICI
    case Other = 99;
}
