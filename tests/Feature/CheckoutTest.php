<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Http\Controllers\CheckoutController;
use App\Models\User;
use App\Models\Order;
use App\Models\Coupon;
use App\Mail\CheckoutCompleted;
use Database\Factories\OrderFactory;
use Illuminate\Support\Facades\Mail;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CheckoutTest extends TestCase
{   
    
    public function test_checkout_completed_mail_queued(): void
    {
        Mail::fake();
        $order = Order::factory()->create();
        $coupon = Coupon::factory()->create();
        $controller = new CheckoutController();
        
        $controller->checkoutCompleted($order, $coupon);
        Mail::assertQueued(CheckoutCompleted::class);
    }
}
