<?php

namespace Database\Factories;

use App\Models\Customer;
use Illuminate\Database\Eloquent\Factories\Factory;

class CustomerFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Customer::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name,
            'address' => $this->faker->address,
            'address_nr' => $this->faker->buildingNumber,
            'postalcode' => $this->faker->postcode,
            'city' => $this->faker->city,
            'country_id' => 1,
            'user_id' => 1, //demo only - Use User factory for id
        ];
    }

}
