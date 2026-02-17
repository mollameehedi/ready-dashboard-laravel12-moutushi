<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
     protected $fillable = [
        'name',
        'code',
        'type',
        'value',
        'min_amount',
        'expires_at',
        'usage_limit',
        'usage_count',
        'usage_limit_per_user',
        'is_active',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'expires_at' => 'datetime',
        'is_active' => 'boolean',
        'value' => 'decimal:2',
        'min_amount' => 'decimal:2',
    ];
}
