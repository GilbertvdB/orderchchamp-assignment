<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\Customer;
use App\Models\Order;
use App\Models\Order2Products;

class OrderService
{   
    /**
     * Process the information required for Order creation.
     */
    public static function processOrder(Request $request)
    {   
        //handle request data
        $customer = 'data';

        $order = self::createOrder($customer);
        $order2Products = self::createOrder2Products($order);

        if (session()->has('cart.coupon')) {
            DiscountService::processDiscount();
        }

        $demo = [
            'order_id' => 1,
            'user_id' => 1,
        ];

        // return $order;
        return $demo;
    }

    /**
     * Creates an order in storage.
     */
    public static function createOrder($customer): Order
    {  
        $order = new Order;
        $order->uuid = Str::uuid();
        $order->billing_customer_id = $customer->id;
        // add more fields
        $order->save();

        return $order;
    }

    /**
     * Creates the order product list for an order in storage.
     */
    public static function createOrder2Products(Order $order)
    {
        $cart = session()->get('cart', []);
        foreach ($cart as $item) {
            $row = new Order2Products;
            $row->order_id = $order->id;
            $row->product_id = $item->id;
            //add more fields
            $row->save();
        }
    }
    
}
