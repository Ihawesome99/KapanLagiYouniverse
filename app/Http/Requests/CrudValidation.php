<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CrudValidation extends FormRequest
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
            'email' => 'required|email',
            'dob' => 'required|date_format:Y-m-d',
            'no_hp' => 'required|numeric|digits_between:10,15',
            'gender' => 'required|in:Male,Female',
            'foto' => 'mimes:jpeg,jpg,png|max:10000|nullable'
        ];
    }
}
