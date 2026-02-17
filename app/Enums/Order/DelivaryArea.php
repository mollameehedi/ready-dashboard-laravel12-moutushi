<?php

namespace App\Enums\Order;

use App\Enums\Commons;

enum DelivaryArea :int
{
    use Commons;
    case InOfDhaka = 1;
    case OutOfDakha = 2;
}
