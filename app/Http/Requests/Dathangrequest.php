<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class Dathangrequest extends FormRequest
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
            'name'=>'required|min:2',
            'gender'=>'required',
            'email'=>'required',
            'adress'=>'required',
            'phone'=>'required'
        ];
    }
    public function messages()
    {
        return [
            'name.required'=>'Bạn chưa nhập tên ',
            'name.min'=>'Tên phải từ 2 kí tự trở lên',
            'gender.required'=>'Bạn chưa nhập giới tính ',
            'email.required'=>'Bạn chưa nhập email',
            'adress.required'=>'Bạn chưa nhập địa chỉ ',
            'phone.required'=>'Bạn chưa nhập số điện thoại '
        ];

    }
}
