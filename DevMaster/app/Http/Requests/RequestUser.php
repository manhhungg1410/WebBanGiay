<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RequestUser extends FormRequest
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
            'name' => 'required|min:3',
            'role_id' => 'not_in:0',
            'email' => 'email|required|unique:users',
            'password' => 'required|min:8',
            'password_confirmation' => 'required|min:8|same:password'
        ];
    }

    public function messages()
    {
        return [
            'name.required' => __('Bạn chưa nhập tên.'),
            'name.min' => __('Tên chứa nhiều hơn 3 kí tự.'),
            'role_id.not_in' => __('Vui lòng chọn quyền.'),
            'email.email' => __('Vui lòng nhập đúng định dạng email.'),
            'email.required' => __('Vui lòng nhập email.'),
            'password.min' => __('Mật khẩu có ít nhất 8 kí tự.'),
            'email.unique' => __('Đã tồn tại email này.'),
            'password.required' => __('Vui lòng nhập mật khẩu'),
            'password_confirmation.required' => __('Vui lòng nhập lại mật khẩu'),
            'password_confirmation.min' => __('Mật khẩu nhập lại có ít nhất 8 kí tự'),
            'password_confirmation.same' => __('Mật khẩu nhập lại không giống mật khẩu')
        ];
    }
}
