<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Coupon2User;
use App\Services\DiscountService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class DiscountServiceTest extends TestCase
{   
    use RefreshDatabase;

    /**
     * A basic feature test example.
     */
    public function test_discountService_tracks_used_coupon_for_user(): void
    {   
        $user = User::factory()->create();
        $cart = [
            'couponId' => 1,
            'couponAmount' => 10,
        ];
        session(['cart' => $cart]);

        Auth::shouldReceive('id')->andReturn(2);

        DiscountService::processDiscount();

        $this->assertDatabaseHas('coupon2_users', [
            'coupon_id' => $cart['couponId'],
            'user_id' => Auth::id(),
            'amount' => $cart['couponAmount'],
        ]);
    }
}
