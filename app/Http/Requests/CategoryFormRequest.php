<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CategoryFormRequest extends FormRequest
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
            'name' => 'required|unique:App\Category|max:15'
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
            'name.required' => 'Το όνομα κατηγορίας είναι απαραίτητο',
            'name.unique' => 'Η κατηγορία υπάρχει ήδη',
            'name.max' => 'Επιτρέπεται να έχει μέχρι 15 χαρακτήρες μόνο'
        ];
    }
}
