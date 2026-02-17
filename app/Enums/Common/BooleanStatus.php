<?php

namespace App\Enums\Common;

use App\Enums\Commons;

enum BooleanStatus : int
{
    use Commons;
    case Yes = 1;
    case No = 0;
}
