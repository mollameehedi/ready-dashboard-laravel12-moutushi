<?php

namespace App\Enums\Product;

use App\Enums\Commons;

enum ProductHighLight :int
{
    use Commons;
    case New = 1;
    case Best = 2;
    case Popular = 3;
}
