<?php

namespace App\Enums\Common;

use App\Enums\Commons;

enum Role :int
{
    use Commons;
    case Admin = 1;
    case Customer = 2;
}
