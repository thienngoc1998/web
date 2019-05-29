<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class Registerrequest extends FormRequest
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
            'username'=>'required|min:3',
            'email' => 'required|email|unique:users,email',
            'password'=>'required',
            'corfimpassword'=>'required|same:password'
        ];
    }
    public function messages()
    {
        return [
            'username.required'=>'Tên là bắt buộc!!!',
            'email.required'=>'Tên là bắt buộc!!!',
            'email.unique'=>'Email đã tồn tại!!!',
            'password.required'=>'Tên là bắt buộc!!!',
            'corfimpassword.required'=>'Tên là bắt buộc!!!',
            'username.min'=>'Tên phải từ 2 kí tự trở lên',
            'email.email'=>'Email phải đúng định dạng',
            'corfimpassword.same'=>'Mật khẩu không khớp'
        ];

    }
}
