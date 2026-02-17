<?php

namespace App\Enums\Finance;

use App\Enums\Commons;

enum PaymentMethod:int
{
    use Commons;
    case Cash = 1;
    case Bkash = 2;
    case Nagad = 3;
}
