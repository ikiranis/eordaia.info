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
        $fileRules = $this->isMethod('put')
            ? 'nullable'
            : 'required|image';

        return [
            'file' => $fileRules,
            'description' => 'nullable',
            'referral' => 'nullable|active_url'
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
            'file.required' => 'Το αρχείο είναι απαραίτητο',
            'file.image' => 'Το αρχείο πρέπει να είναι εικόνα',
            'referral.active_url' => 'Η πηγή πρέπει να είναι ενεργό link'
        ];
    }
}
