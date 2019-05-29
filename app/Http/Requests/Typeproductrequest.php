<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class Typeproductrequest extends FormRequest
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
         'name'=>'required|min:5|max:25',
         'description'=>'required|min:5|max:25',
         'image'=>'mimes:jpeg,jpg,png,gif|required|max:10000'
        ];
    }
    public function messages()
    { 
     return [
     'name.required'=>'Bạn chưa nhập Tên ',
    'name.min'=>'Tên phải từ 5 đến 25 ký tự ',
    'name.max'=>'Tên phải từ 5 đến 25 ký tự',
    'description.required'=>'Bạn chưa nhập mô tả ',
    'description.min'=>'Mô tả phải từ 5 đến 25 ký tự ',
    'description.max'=>'Mô tả phải từ 5 đến 25 ký tự',
    'image.required'=>'Bạn chưa chọn ảnh ',
    'image.mimes'=>'Định dạng ảnh sai ',
    'image.max'=>'Dung lượng file quá 10000KB '
    ];
        
    }
}
