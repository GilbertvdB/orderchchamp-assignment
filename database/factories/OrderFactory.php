<?php

namespace Database\Factories;

use App\Models\Order;
use Illuminate\Database\Eloquent\Factories\Factory;

class OrderFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Order::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'order_number' => 'Ord-12345',
            'subtotal' => 20, 
            'shipping' => 5, 
            'coupon' => 4,
            'tax' => 3,
            'total' => 21,
            'customer_id' => 1,
        ];
    }

}
