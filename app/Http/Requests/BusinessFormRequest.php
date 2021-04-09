<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BusinessFormRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required',
            'address' => 'required',
            'email' => 'required|email:rfc,dns',
            'slug' => 'required|unique:businesses'
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'name.required' => 'Το όνομα εταιρείας απαιτείται',
            'address.required'  => 'Η διεύθυνση απαιτείται',
            'email.required'  => 'Το email απαιτείται',
            'email.email'  => 'To email δεν είναι έγκυρο',
            'slug.required' => 'Το slug απαιτείται',
            'slug.unique' => 'Το slug υπάρχει ήδη',
        ];
    }
}
