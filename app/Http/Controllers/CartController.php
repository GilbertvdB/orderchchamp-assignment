<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class CartController extends Controller
{   
    /**
     * Display the contents of the cart.
     */
    public function index(): View
    {
        $cart = session()->get('cart', []);

        return view('cart.index', compact('cart'));
    }

    /**
     * Add items to cart in session storage.
     */
    public function addToCart(Request $request): RedirectResponse
    {
        $productId = $request->input('product_id');
        $quantity = $request->input('quantity', 1);

        $cart = session()->get('cart', []);

        if (isset($cart[$productId])) {
            $cart[$productId] += $quantity;
        } else {
            $cart[$productId] = $quantity;
        }

        session()->put('cart', $cart);

        return redirect()->route('cart.index');
    }

    /**
     * Update items in cart in session storage.
     */
    public function updateCart(Request $request)
    {
        // code to update items in cart
    }

    /**
     * Remove items from cart in session storage.
     */
    public function removeFromCart(Request $request)
    {
        //code to remove items from cart
    }
}
