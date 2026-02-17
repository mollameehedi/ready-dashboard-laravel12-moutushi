<?php

namespace App\Models\Order;

use App\Models\Product\Product;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class OrderDetails extends Model
{
 use HasFactory;
 protected $fillable = [
    'order_id',
    'order_number',
    'product_id',
    'price',
    'discount',
    'quantity',
    'title',
    'model',
    'color',
    'size',
    'review',
    'rating',
];
 public function product()
    {
        return $this->belongsTo(Product::class,'product_id','id');
    }
    public function order(){
        return $this->belongsTo(Order::class);
    }
}
