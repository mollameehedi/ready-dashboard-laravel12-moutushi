<?php

namespace App\Enums;

use App\Enums\Commons;

enum CouponType :int
{
    use Commons;
    case Fixed = 1;
    case Percentage = 2;
}
