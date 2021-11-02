<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;

class RequestProduct extends FormRequest
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
            // check request các trường
            'name' => 'bail|required|min:5',
            'image' => 'bail|image|required|max:2024',
            'price' => 'bail|required',
            'sale' => 'bail|required',
            'category_id' => 'not_in:0',
            'brand_id' => 'not_in:0',
            'slug' => 'unique:products'
        ];
    }

    public function messages()
    {
        return [
            // bắn ra lỗi
            'name.required' => __('Bạn chưa nhập tên.'),
            'name.min' => __('Tên chứa nhiều hơn 5 kí tự.'),
            'image.required' => __('Bạn chưa chọn ảnh.'),
            'image.max' => __('Ảnh của bạn phải có kích thước nhỏ hơn 2MB.'),
            'image.image' => __('File của bạn phải là ảnh.'),
            'price.required' => __('Vui lòng nhập giá sản phẩm.'),
            'sale.required' => __('Vui lòng nhập giá sau khi sale.'),
            'category_id.not_in' => __('Vui lòng chọn mã danh mục.'),
            'brand_id.not_in' => __('Vui lòng chọn mã thương hiệu.'),
            'slug.unique' => __('Slug của bạn đã tồn tại')
        ];
    }
}
