<?php

namespace App\Http\Requests\Admins;

use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Http\FormRequest;

class SettingRequest extends FormRequest
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
        if ($this->isMethod('get')) {
            return [];
        }
        return [
            'so_dien_thoai' => ['required', 'digits:10',Rule::unique('users','so_dien_thoai')->ignore(Auth::id())], // Bắt đầu bằng 0, có 10-11 số
            'email' => ['required','email',Rule::unique('users','email')->ignore(Auth::id())],
            'anh_dai_dien' => 'nullable|image|max:2048',
            'ten_nguoi_dung' => 'required',
            'dia_chi' => 'required',
            'ngay_sinh' => 'required|date',
            'gioi_tinh' => 'required',
        ];
    }

    public function messages(): array
    {
        return [

            'email.required' => 'Vui lòng nhập email',
            'email.email' => 'Vui lòng nhập email đúng định dạng',
            'email.unique' => 'Email này đã tồn tại vui lòng nhập email khác',

            'anh_dai_dien.image' => 'Vui lòng nhập định dạng ảnh max 2048mb',
            'anh_dai_dien.required' => 'Vui lòng chọn hình ảnh',

            'ten_nguoi_dung.required' => 'Vui lòng nhập tên ',
            'dia_chi.required' => 'Vui lòng nhập địa chỉ dùng',
            'ngay_sinh.required' => 'Vui lòng nhập ngày sinh ',
            'gioi_tinh.required' => 'Vui lòng chọn giới tính ',

            'so_dien_thoai.required' => 'Vui lòng nhập số điện thoại',
            'so_dien_thoai.digits' => 'Vui lòng nhập số điện thoại có 10 số',
            'so_dien_thoai.unique' => 'Số điện thoại đã tồn tại',

        ];
    }
}
