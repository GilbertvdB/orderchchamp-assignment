<?php

namespace App\Services;

use App\Models\Coupon2User;
use Illuminate\Support\Facades\Auth;

class DiscountService
{   
    /**
     * Tracks the coupon and the ammount used by the user.
     */
    public static function processDiscount()
    {   
        $cart = session()->get('cart', []);

        Coupon2User::create([
            'coupon_id' => $cart['couponId'],
            'user_id' => Auth::id(),
            'amount' => $cart['couponAmount'],
        ]);
    }
    
}
