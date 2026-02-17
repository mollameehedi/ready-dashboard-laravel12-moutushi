<?php

namespace App\Models\Product;

use Illuminate\Database\Eloquent\Model;

class ProductStock extends Model
{
    protected $fillable = [
        'product_id',
        'quantity',
        'type',
        'description',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
