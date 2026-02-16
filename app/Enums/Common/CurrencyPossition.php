<?php

namespace App\Enums\Common;

use App\Enums\Commons;

enum CurrencyPossition:int
{
    use Commons;
    case Left = 1;
    case Right = 2;
}
