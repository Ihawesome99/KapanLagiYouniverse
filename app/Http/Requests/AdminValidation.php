<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AdminValidation extends FormRequest
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
        $password = 'required|min:3';
        
        if($this->route()->parameter('id')) {
            $password = 'nullable|min:3';
        }

        return [
            'name' => 'required|min:3',
            'email' => 'required|email|min:3|unique:users,email,'.$this->route()->parameter('id').'.,id',
            'password' => $password
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Nama harus diisi',
            'name.min' => 'Nama minimal :min karakter',
            'email.required' => 'Email harus diisi',
            'email.email' => 'Format email anda belum benar',
            'email.unique' => 'Email sudah terdaftar, mohon memakai email yang lain',
            'password.required' => 'Password harus diisi',
            'password.min' => 'Password minimal :min karakter',
            'password.confirmed' => 'Konfirmasi password tidak cocok'
        ];
    }
}
