<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PhotoFormRequest extends FormRequest
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
            'file' => 'required|image',
            'url' => 'nullable|active_url',
            'description' => 'nullable'
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
            'file.required' => 'Το αρχείο απαιτείται',
            'file.image' => 'Το αρχείο πρέπει να είναι εικόνα',
            'url.active_url' => 'Το url πρέπει να είναι ενεργό'
        ];
    }
}
