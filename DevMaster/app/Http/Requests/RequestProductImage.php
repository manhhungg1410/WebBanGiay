<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RequestProductImage extends FormRequest
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
            'product_id'=>'bail|not_in:0',
            'image' => 'bail|image|max:2024'
        ];
    }

    public function messages()
    {
        return [
          'product_id.not_in' => 'Vui lòng chọn sản phẩm',
            'image.max' => __('Ảnh của bạn phải có kích thước nhỏ hơn 2MB.'),
            'image.image' => __('File của bạn phải là ảnh.')
        ];
    }
}
