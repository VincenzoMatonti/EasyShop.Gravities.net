<?php

namespace App\Enum;

enum LabelEmail: int
{
    // PERSONALI
    case Personal = 1;
    case Work = 2;

        // BUSINESS
    case Billing = 10;
    case Orders = 11;
    case Support = 12;
    case Sales = 13;
    case Marketing = 14;
    case Info = 15;

        // GENERICO
    case Other = 99;
}
