<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCustomerRequest;
use App\Models\User;
use App\Models\Customer;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class CustomerController extends Controller
{
    /**
     * Register the user and continue step 1 checkout process.
     */
    public function register(Request $request): RedirectResponse
    {   
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
     * Display the users profile.
     */
    public function profile(string $id): View
    {
        $user = User::findOrFail($id);

        return view('customer.profile', compact('user'));
    }


    /**
     * Update the users profile in storage.
     */
    public function update(Request $request, string $id): RedirectResponse
    {
        //

        return redirect()->route('customer.profile')->with('success', 'Profile updated!');
    }
}
