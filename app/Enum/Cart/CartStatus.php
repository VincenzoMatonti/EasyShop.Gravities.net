<?php

namespace App\Enum\Cart;

enum CartStatus: int
{
    case active = 1;
    case converted = 2;
    case abandoned = 3;
}
