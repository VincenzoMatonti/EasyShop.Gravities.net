<?php

namespace App\Enum\Order;

enum OrderStatus: int
{
    case pending = 1;
    case paid = 2;
    case processing = 3;
    case shipped = 4;
    case delivered = 5;
    case cancelled = 6;
}
