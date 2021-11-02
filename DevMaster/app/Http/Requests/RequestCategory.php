<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;

class RequestCategory extends FormRequest
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
            'slug' => Str::slug($this->name),
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
            // check request các trường
            'name' => 'bail|required|min:5|string',
            'image' => 'bail|image|max:2024',
            'slug' => 'unique:categories'
        ];
    }

    public function messages()
    {
        return [
            // bắn ra lỗi
            'name.required' => __('Bạn chưa nhập tên.'),
            'name.min' => __('Tên chứa nhiều hơn 5 kí tự.'),
            'image.max' => __('Ảnh của bạn phải có kích thước nhỏ hơn 2MB.'),
            'image.image' => __('File của bạn phải là ảnh.'),
            'slug.unique' => __('Slug của bạn đã tồn tại')
        ];
    }
}
