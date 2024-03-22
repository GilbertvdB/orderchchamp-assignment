<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Customer;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class CustomerController extends Controller
{
    /**
     * Display the specified resource.
     */
    public function register(Request $request): RedirectResponse
    {   

        //todo check if user or customer data is already created or not
        $newUser = User::create([
            'name'     => $request->input('name'),
            'email'    => $request->input('email'),
            'password' => Hash::make(Str::random(8)), //todo send mail with password/resetPassword
        ]);

        $newCustomer = new Customer;
        $newCustomer->name = $newUser->name;
        $newCustomer->address = $request->input('address');
        $newCustomer->address_nr = $request->input('address_nr');
        $newCustomer->postalcode = $request->input('postalcode');
        $newCustomer->city = $request->input('city');
        $newCustomer->country_id = 1; //demo purpose
        $newCustomer->user_id = $newUser->id;
        $newCustomer->save();
        
        Auth::login($newUser);
        
        return redirect()->route('checkout.step1')->with('success', 'Registration successful!');
    }

    /**
     * Display the specified resource.
     */
    public function profile(string $id)
    {
        $user = User::findOrFail($id);

        return view('customer.profile', compact('user'));
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $customer = Customer::findOrFail($id);
        
        $customer->name = $request->input('name');
        $customer->address = $request->input('address');
        $customer->address_nr = $request->input('address_nr');
        $customer->postalcode = $request->input('postalcode');
        $customer->city = $request->input('city');
        // $customer->country_id = $request->input('country_id');
        $customer->save();

        return redirect()->route('customer.profile')->with('success', 'Profile updated!');
    }
}
