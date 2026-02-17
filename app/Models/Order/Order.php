<?php

namespace App\Models\Order;

use App\Enums\Order\OrderStatus;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Order extends Model
{
    use HasFactory;
    protected $fillable = [
        'order_number',
        'name',
        'user_id',
        'email',
        'phone',
        'address',
        'delivary_area',
        'amount',
        'discount',
        'shipping_charge',
        'order_status',
        'payment_status',
        'payment_method',
        'message',
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function items()
    {
        return $this->hasMany(OrderDetails::class,'order_number','order_number');
    }
    public function scopeDelivered($query){
        return $query->where('order_status',OrderStatus::Delivered->value);
    }
    public function scopePending($query){
        return $query->where('order_status',OrderStatus::Pending->value);
    }
    public function scopeCancel($query){
        return $query->where('order_status',OrderStatus::Cancel->value);
    }
    public function scopeCountData($query){
        return $query->select('order_status','created_at');
    }
        public function orderDetails(): HasMany
    {
        return $this->hasMany(OrderDetails::class, 'order_id');
    }


     protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
                $model->order_number = self::generateUniqueOrderId();
        });
    }

    /**
     * Generates a unique order ID that contains numbers.
     *
     * This method is now a private static method within the model itself,
     * so it can only be called from within the `Order` class.
     *
     * @return string The unique order ID.
     */
    private static function generateUniqueOrderId(): string
    {
        $microtime = microtime(true);
        $seconds = floor($microtime);
        $milliseconds = round(($microtime - $seconds) * 1000);
        $timePart = date('ymd', $seconds) . str_pad($milliseconds, 2, '0', STR_PAD_LEFT);
        $uniqueId = $timePart;

        return $uniqueId;
    }
}
