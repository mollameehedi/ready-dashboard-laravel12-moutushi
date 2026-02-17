<?php

namespace App\Enums\Order;

use App\Enums\Commons;

enum OrderStatus :int
{
    use Commons;
    case Delivered = 1;
    case Pending = 2;
    case Accept = 3;
    case Processing = 4;
    case Shipping = 5;
    case Cancel = 6;
}
