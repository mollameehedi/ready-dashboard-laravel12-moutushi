<?php

namespace App\Services;

use App\Models\Coupon;
use App\Enums\CouponType;
use App\Models\CouponLog;
use Exception;
use Illuminate\Support\Facades\Auth;

class CouponCalculationService
{
    /**
     * Calculates the discount amount for a given coupon and subtotal.
     *
     * @param string $couponCode The code of the coupon to apply.
     * @param float $subTotal The total amount of the order before discount.
     * @return float The calculated discount amount.
     * @throws Exception If the coupon is not found or is not valid.
     */
    public function calculateDiscount(string $couponCode, float $subTotal,$type = null): float
    {

        // Find the coupon by its code.
        $coupon = Coupon::where('usage_count','=<','usage_limit')->where('code', $couponCode)->first();
        // If no coupon is found, throw an exception.
        if (!$coupon) {
            throw new Exception('Invalid coupon code.');
        }
        if(CouponLog::where('coupon_id', $coupon->id)
    ->where('user_id', Auth::id())
    ->exists()){
            $discountAmount = 0.0;
        }
        else{
             if ($coupon->type == CouponType::Fixed->value) {
            $discountAmount = $coupon->value;
            if ($discountAmount > $subTotal) {
                $discountAmount = $subTotal;
            }
        } elseif ($coupon->type == CouponType::Percentage->value) {
            $discountAmount = ($subTotal * $coupon->value) / 100;
        }
        if($type != null && $type == 'create'){
            CouponLog::create([
                'coupon_id' => $coupon->id,
                'user_id' => Auth::id(),
                'amount' => $discountAmount,
        ]);
        }

        $coupon->increment('usage_count',1);
        }

        return $discountAmount;
    }
}
