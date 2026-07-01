<?php

namespace App\Enum\Catalog;

enum ProductStatus: int
{
    case Draft = 1;
    case Published = 2;
    case Archived = 3;
}
