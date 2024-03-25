<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Order;
use App\Models\Coupon;
use App\Services\OrderService;
use App\Mail\CheckoutCompleted;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\RedirectResponse;

class CheckoutController extends Controller
{   
    /**
     * Display the first step of the checkout process.
     */
    public function step1(): View
    {
        return view('checkout.step1-details');
    }

    /**
     * Display the second step of the checkout process.
     */
    public function step2(): View
    {
        return view('checkout.step2-payment');
    }

    /**
     * Order confirmation of the checkout process.
     */
    public function confirmOrder(Request $request)
    {   
        //handle request,validation etc
        $extraData = 'placeholder';
        $user = Auth::user();
        
        try {
            $order = OrderService::createOrder($user, $extraData);
            
            $coupon = Coupon::find('id'); //fetch coupon data
            
            self::checkoutCompleted($order, $coupon);
            
        } catch (\Exception $e) {
                // Log the error
  
        }
                
    }
    
    /**
     * Checkout completion of the checkout process.
     */
    public function checkoutCompleted(Order $order, Coupon $coupon): RedirectResponse
    {   
        Mail::to(auth()->user())
            ->later(now()->addMinutes(15), new CheckoutCompleted($order, $coupon));
    
        return redirect()->route('checkout.success');
        
    }

    /**
     * Display the specified resource.
     */
    public function success(): View
    {
        return view('checkout.success');
    }

    /**
     * Display the specified resource.
     */
    public function failed(): View
    {
        return view('checkout.failed');
    }
    
}