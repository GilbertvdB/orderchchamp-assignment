<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCustomerRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name'       => 'required|max:255',
            'email'      => 'required|max:255',
            'address'    => 'required|max:255',
            'address_nr' => 'required|max:255',
            'postalcode' => 'required|max:255',
            'city'       => 'required|max:255',
            'country_id' => 'required|max:255',
        ];
    }
}
