<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class AuthRequest extends FormRequest
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
            'name'     => 'required|string',
            'email'    => 'required|string|unique:admins,email',
            'password' => 'required|string|min:5|max:13',
            'phone'    => 'required|string',
            'birthday' => 'required|string',
        ];
    }
    // public function messages()
    // {
    //     return [
    //         'name.required' => 'tên không được để trống',
    //         'email.required' => 'email không được để trống',
    //         'email.unique' => 'email không được trùng',
    //         'password.required' => 'pass không được để trống',
    //         'password.min' => 'pass phải dài hơn 5 kí tự',
    //         'password.max' => 'pass không được quá 13 kí tự',
    //         'phone.required' => 'số điện thoại không được để trống',
    //         'birthday.required' => 'ngày sinh không được để trống',
    //     ];
    // }
}
