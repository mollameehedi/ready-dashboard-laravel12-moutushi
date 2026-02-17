<?php

namespace App\Enums\Finance;

use App\Enums\Commons;

enum PaymentStatus:int
{
    use Commons;
    case Paid = 1;
    case UnPaid = 0;
}
