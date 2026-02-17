<?php

namespace App\Models\Product;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class FlashSaleProduct extends Model
{

    protected $fillable = [
        'flash_sale_id',
        'product_id',
        'quantity',
        'sold_quantity',
        'price',
        'is_active',
    ];

    public function flashSale()
    {
        return $this->belongsTo(FlashSale::class,'flash_sale_id');
    }

    public function product()
    {
        return $this->belongsTo(Product::class,'product_id')->shortData();
    }
    public function scopeActive($query){
        return $query->where('is_active',1);
    }
    public function scopeIsQuantity($query){
        return $query->where('quantity','>',DB::raw('sold_quantity'));
    }
}
