<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * @property mixed tags
 * @property mixed categories
 * @property mixed photos
 */
class PostFormRequest extends FormRequest
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
            'slug' => 'nullable',
            'user_id' => 'nullable',
            'title' => 'required|max:255',
            'body' => 'required',
            'reference' => 'nullable|url|max:800',
            'approved' => 'nullable',
            'image_id' => 'nullable'
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
            'title.required' => 'Ο τίτλος απαιτείται',
            'body.required'  => 'Το κείμενο απαιτείται',
        ];
    }
}
