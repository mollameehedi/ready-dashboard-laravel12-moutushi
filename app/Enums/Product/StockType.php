<?php

namespace App\Enums\Product;

use App\Enums\Commons;

enum StockType :int
{
    use Commons;
    case Addition = 1;
    case Deduction = 0;
}
