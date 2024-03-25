<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CartTest extends TestCase
{
    public function test_cart_index_route_returns_a_succesfull_response(): void
    {
        $response = $this->get('/cart');

        $response->assertSee('Shopping Cart');

        $response->assertStatus(200);
    }

    public function test_user_can_add_items_to_cart(): void
    {
        $product = ['id' => 1, 'name' => 'Awsome Product', 'unit_price' => 9.99];

        $response = $this->post(route('cart.add'), [
            'product_id' => $product['id'],
            'name' => 'Awsome Product',
            'unit_price' => 9.99,
            'quantity' => 2,
        ]);

        $response->assertRedirect(route('cart.index'));

        $this->assertTrue(session()->has('cart'));
        $this->assertArrayHasKey($product['id'], session('cart'));
        $this->assertEquals(2, session('cart')[$product['id']]);
    }
}
