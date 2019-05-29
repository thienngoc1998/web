<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class Sliderequest extends FormRequest
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
            'link'=>'required',
            'image'=>'required|mimes:jpg,png,jpeg,gif|max:10000'
        ];
    }
    public function messages()
    {
        return[
            'image.required'=>'Bạn chưa chọn ảnh',
            'link.required'=>'Bạn chưa nhập link',
            'image.mimes'=>'Ảnh không hợp lệ',
            'image.max'=>'Kích thước ảnh quá lớn'
        ];
    }
}
