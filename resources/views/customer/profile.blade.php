<!-- resources/views/customer/profile.blade.php -->

@extends('layouts.app') <!-- Assuming you have a layout file -->

@section('content')
    <div class="container">
        <h1>Customer Profile</h1>
        
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        
        <div class="row">
            <div class="col-md-6">
                <h2>Profile Information</h2>
                <ul>
                    <li><strong>Name:</strong> {{ $user->customer->name }}</li>
                    <li><strong>Address:</strong> {{ $user->customer->address }}</li>
                    <li><strong>Address Number:</strong> {{ $user->customer->address_nr }}</li>
                    <li><strong>Postal Code:</strong> {{ $user->customer->postalcode }}</li>
                    <li><strong>City:</strong> {{ $user->customer->city }}</li>
                    <li><strong>Country:</strong> {{ $user->customer->country_id }}</li> <!-- Assuming you have a relationship set up -->
                </ul>
            </div>
            <div class="col-md-6">
                <h2>Update Information</h2>
                <form action="{{ route('customer.update', ['id' => $user->id ]) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" name="name" id="name" class="form-control" value="{{ $user->customer->name }}">
                    </div>
                    <div class="form-group">
                        <label for="address">Address</label>
                        <input type="text" name="address" id="address" class="form-control" value="{{ $user->customer->address }}">
                    </div>
                    <div class="form-group">
                        <label for="address_nr">Address Number</label>
                        <input type="text" name="address_nr" id="address_nr" class="form-control" value="{{ $user->customer->address_nr }}">
                    </div>
                    <div class="form-group">
                        <label for="postalcode">Postal Code</label>
                        <input type="text" name="postalcode" id="postalcode" class="form-control" value="{{ $user->customer->postalcode }}">
                    </div>
                    <div class="form-group">
                        <label for="city">City</label>
                        <input type="text" name="city" id="city" class="form-control" value="{{ $user->customer->city }}">
                    </div>
                    <!-- Country select here -->
                    <button type="submit" class="btn btn-primary">Update</button>
                </form>
            </div>
        </div>
    </div>
@endsection
