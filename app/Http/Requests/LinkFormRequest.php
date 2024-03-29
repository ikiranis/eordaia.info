<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LinkFormRequest extends FormRequest
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
            'url' => 'required|active_url'
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
            'url.required' => 'To url απαιτείται',
            'url.active_url' => 'Το link πρέπει να είναι ενεργό'
        ];
    }
}
