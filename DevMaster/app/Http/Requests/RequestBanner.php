<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;

class RequestBanner extends FormRequest
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

    protected function prepareForValidation()
    {
        $this->merge([
            'slug' => Str::slug($this->title),
        ]);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title' => 'bail|required|min:5',
            'image' => 'bail|max:2024|image',
            'slug' => 'unique:banners'
        ];
    }



    public function messages()
    {
        // bắn ra lỗi
       return [
           'title.required' => __('Bạn chưa nhập tiêu đề.'),
           'title.min' => __('Tiêu đề chứa nhiều hơn 5 kí tự.'),
           'image.max' => __('Ảnh của bạn phải có kích thước nhỏ hơn 2MB.'),
           'image.image' => __('File của bạn phải là ảnh.'),
           'slug.unique' => __('Slug của bạn đã tồn tại')
       ];
    }
}
