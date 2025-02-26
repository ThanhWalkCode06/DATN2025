<?php

namespace App\Http\Requests\Admins;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => [
                'required',
                Rule::unique('users', 'username')->ignore($this->route('user'))
            ],
            'email' => [
                'required','email',
                Rule::unique('users', 'email')->ignore($this->route('user'))
            ],
            'anh_dai_dien' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'role' => '',
            'ten_nguoi_dung' => 'required',
            'dia_chi' => 'required',
            'ngay_sinh' => ['required','date'
                ,'before_or_equal:' .  now()->subYear(18)->format('Y-m-d')
            ],
            'gioi_tinh' => 'required',
            'so_dien_thoai' => [
                'required','digits:10',
                Rule::unique('users', 'so_dien_thoai')->ignore($this->route('user'))
            ],
            'password' => 'required|min:6',
            'password_verify' => 'required|same:password',
            'trang_thai' => ''
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Vui lòng nhập tên tài khoản',
            'name.unique' => 'Tên tài khoản này đã tồn tại vui lòng nhập khác',

            'email.required' => 'Vui lòng nhập email',
            'email.email' => 'Vui lòng nhập email đúng định dạng',
            'email.unique' => 'Email này đã tồn tại vui lòng nhập email khác',

            'anh_dai_dien.image' => 'Vui lòng nhập định dạng ảnh max 2048mb',
            'anh_dai_dien.required' => 'Vui lòng chọn hình ảnh',

            'ten_nguoi_dung.required' => 'Vui lòng nhập tên ',
            'dia_chi.required' => 'Vui lòng nhập địa chỉ dùng',
            'ngay_sinh.required' => 'Vui lòng nhập ngày sinh ',
            'ngay_sinh.before_or_equal' => 'Chưa đủ 18 tuổi',
            'gioi_tinh.required' => 'Vui lòng chọn giới tính ',

            'so_dien_thoai.required' => 'Vui lòng nhập số điện thoại',
            'so_dien_thoai.digits' => 'Vui lòng nhập số điện thoại có 10 số',
            'so_dien_thoai.unique' => 'Số điện thoại đã tồn tại',

            'password.required' => 'Vui lòng nhập mật khẩu',
            'password.min' => 'Ít nhất là 6 kí tự',
            'password_verify.required' => 'Vui lòng nhập mật khẩu xác nhận',
            'password_verify.same' => 'Vui lòng nhập mật khẩu giống nhau',
        ];
    }
}
