<?php

namespace App\Models\Product;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class FlashSale extends Model  implements HasMedia
{
    use InteractsWithMedia;
    protected $fillable = [
        'name',
        'start_date',
        'end_time',
        'is_current',
    ];

    protected $casts = [
        'start_date' => 'datetime',
        'end_time' => 'datetime',
    ];
    public function scopeActive($query)
    {
        return $query->where('is_current', 1)->first();
    }
    public function scopeActiveFlash($query)
    {
        return $query->where('is_current', 1)
                         ->where('start_date', '<=', Carbon::now())
                         ->where('end_time', '>=', Carbon::now());
    }

    public function flashProduct()
    {
        return $this->hasMany(FlashSaleProduct::class);
    }

}

