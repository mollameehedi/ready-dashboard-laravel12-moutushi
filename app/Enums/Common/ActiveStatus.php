<?php

namespace App\Enums\Common;

use App\Enums\Commons;

enum ActiveStatus:int
{
    use Commons;
    case Active = 1;
    case Inactive = 0;
}
