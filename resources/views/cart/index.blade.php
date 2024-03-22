@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Shopping Cart</h1>
        @if (count($cart) > 0)
            <table class="table">
                <thead>
                    <tr>
                        <th>Product</th>
                        <th>Quantity</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($cart as $productId => $quantity)
                        <tr>
                            <td>Product {{ $productId }}</td> <!-- Replace with actual product details -->
                            <td>{{ $quantity }}</td>
                            <td>
                                <form action="{{ route('cart.update') }}" method="POST" style="display: inline;">
                                    @csrf
                                    <input type="hidden" name="product_id" value="{{ $productId }}">
                                    <input type="number" name="quantity" value="{{ $quantity }}" min="1">
                                    <button type="submit">Update</button>
                                </form>
                                <form action="{{ route('cart.remove') }}" method="POST" style="display: inline;">
                                    @csrf
                                    <input type="hidden" name="product_id" value="{{ $productId }}">
                                    <button type="submit">Remove</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <p>Cart is empty</p>
        @endif
    </div>
@endsection