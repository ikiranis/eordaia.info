<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BizpostFormRequest extends FormRequest
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
            'title' => 'required|max:255',
            'body' => 'required',
            'kind' => 'required',
            'due_date' => 'required|date'
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
            'kind.required'  => 'Ο τύπος απαιτείται',
            'due_date.required'  => 'Η ημερομηνία λήξης απαιτείται',
            'due_date.date'  => 'Η ημερομηνία λήξης δεν είναι έγκυρη'
        ];
    }
}
