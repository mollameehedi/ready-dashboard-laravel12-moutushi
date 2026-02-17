<?php

namespace App\Http\Controllers\Front;

use App\Enums\CouponType;
use App\Http\Controllers\Controller;
use App\Models\Coupon;
use App\Models\CouponLog;
use App\Models\Order\Order;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CouponController extends Controller
{
    public function applyCoupon(Request $request)
    {
        $request->validate([
            'coupon_code' => 'required|string|max:255',
            'sub_total' => 'required|numeric|min:0',
        ]);

        $couponCode = $request->input('coupon_code');
        $subTotal = $request->input('sub_total');
        $discountAmount = 0;

        $coupon = Coupon::where('code', $couponCode)
                        ->where('is_active', true)
                        ->first();

        if (!$coupon) {
            return response()->json([
                'success' => false,
                'message' => 'Invalid coupon code.',
            ]);
        }
       if(!Auth::id()){
            return response()->json([
                'success' => false,
                'message' => 'Login First For Use Coupon!!',
            ]);
        }

       if(CouponLog::where('coupon_id', $coupon->id)->where('user_id', Auth::id())->exists()){
            return response()->json([
                'success' => false,
                'message' => 'You Have Already Taken!!',
            ]);
        }

        // Check if coupon has expired
        if ($coupon->expires_at && Carbon::now()->greaterThan($coupon->expires_at)) {
            return response()->json([
                'success' => false,
                'message' => 'Coupon has expired.',
            ]);
        }

        // Check overall usage limit
        if ($coupon->usage_limit !== null && $coupon->usage_count >= $coupon->usage_limit) {
            return response()->json([
                'success' => false,
                'message' => 'This coupon has reached its maximum usage limit.',
            ]);
        }

        // Check usage limit per user if authenticated
        if (Auth::check() && $coupon->usage_limit_per_user !== null) {
            // You would need a way to track user-specific coupon usage,
            // e.g., a 'coupon_usages' table with 'user_id' and 'coupon_id'.
            // For demonstration, let's assume a simple check.
            // $userCouponUsageCount = Order::where('user_id', Auth::id())
            //                                         ->whereHas('orderDetails', function($query) use ($coupon) {
            //                                             $query->where('coupon_id', $coupon->id);
            //                                         })
            //                                         ->count();

            // if ($userCouponUsageCount >= $coupon->usage_limit_per_user) {
            //     return response()->json([
            //         'success' => false,
            //         'message' => 'You have already used this coupon the maximum number of times.',
            //     ]);
            // }
        }

        // Check minimum amount
        if ($coupon->min_amount !== null && $subTotal < $coupon->min_amount) {
            return response()->json([
                'success' => false,
                'message' => 'Minimum order amount of ' . price($coupon->min_amount) . ' required for this coupon.',
            ]);
        }

        // Calculate discount
        // dd($coupon->type == CouponType::Fixed->value);
        if ($coupon->type == CouponType::Fixed->value) { // Assuming 1 for fixed amount
            $discountAmount = $coupon->value;
            if ($discountAmount > $subTotal) {
                $discountAmount = $subTotal; // Discount cannot exceed subtotal
            }
        } elseif ($coupon->type == CouponType::Percentage->value) { // Assuming 2 for percentage
            $discountAmount = ($subTotal * $coupon->value) / 100;
        }
        // Store applied coupon in session for order processing
        session()->put('coupon', [
            'code' => $coupon->code,
            'id' => $coupon->id,
            'discount_amount' => $discountAmount,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Coupon applied successfully!',
            'discount_amount' => $discountAmount,
        ]);
    }

    /**
     * Remove applied coupon from session.
     * This method is not explicitly requested but is good practice to have.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function removeCoupon(Request $request)
    {
        session()->forget('coupon');

        return response()->json([
            'success' => true,
            'message' => 'Coupon removed successfully.',
        ]);
    }
}
