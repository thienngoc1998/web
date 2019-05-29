<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class Loginrequest extends FormRequest
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
            'email'=>'required|email',
            'password'=>'required|min:1'
        ];
    }
    public function messages()
    {
        return [
            'email.required'=>'Email là bắt buộc',
            'email.email'=>'Email không đúng ',
            'password.required'=>'Password là bắt buộc',
            'password.min'=>'password từ 1 kí tự'
        ];

    }
}
