<?php

namespace Tests\Feature;

use App\Http\Requests\StoreCustomerRequest;
use Tests\TestCase;
use App\Models\User;
use App\Models\Customer;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CustomerTest extends TestCase
{   
    use RefreshDatabase;

    public function test_user_can_register_at_checkout(): void
    {
        $formData = [
            'name' => 'Test User',
            'email' => 'testuser@test.com',
            'address' => '123 Test Street',
            'address_nr' => '101',
            'postalcode' => '12345',
            'city' => 'Test City',
        ];

        $response = $this->post(route('customer.register'), $formData);
        $response->assertRedirect(route('checkout.step1'));
        $this->assertDatabaseHas('users', ['email' => $formData['email']]);
        $this->assertDatabaseHas('customers', ['name' => $formData['name']]);
        $this->assertAuthenticated();
    }

    public function test_user_can_view_profile_page(): void
    {
        $user = User::factory()->create();
        $customer = Customer::factory()->create();
        $customer->user_id = $user->id;
        $customer->save();

        $response = $this->actingAs($user)->get(route('customer.profile', ['id' => $user->id]));

        $response->assertOk();
    }
}
