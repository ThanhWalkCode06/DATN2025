<?php

namespace App\Http\Requests\Client;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class ThanhToanRequest extends FormRequest
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
            'email_nguoi_nhan' => [
                'required','email',
            ],
            'ten_nguoi_nhan' => 'required',
            'sdt_nguoi_nhan' => [
                'required','digits:10'
            ],
            'dia_chi_nguoi_nhan' => 'required',

            'tong_tien' => 'required',
            'giam_gia' => 'nullable',
            'voucher_code' => 'nullable',
            'phuong_thuc_thanh_toan_id' => 'required',
            'ward' => 'required',
            'district' => 'required',
            'province' => 'required',
        ];
    }

    public function messages(): array
    {
        return [
            'email_nguoi_nhan.required' => 'Vui lòng nhập email',
            'email_nguoi_nhan.email' => 'Vui lòng nhập email đúng định dạng',
            'ten_nguoi_nhan.required' => 'Vui lòng nhập họ và tên ',
            'province.required' => 'Vui lòng chọn tỉnh',
            'district.required' => 'Vui lòng chọn quận huyện',
            'ward.required' => 'Vui lòng chọn phường xã',
            'dia_chi_nguoi_nhan.required' => 'Vui lòng nhập địa chỉ nhận hàng',
            'phuong_thuc_thanh_toan_id.required' => 'Vui lòng chọn phương thức thanh toán',

            'sdt_nguoi_nhan.required' => 'Vui lòng nhập số điện thoại',
            'sdt_nguoi_nhan.digits' => 'Vui lòng nhập số điện thoại có 10 số',
        ];
    }
}
