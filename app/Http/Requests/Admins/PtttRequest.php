<?php

namespace App\Http\Requests\Admins;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class PtttRequest extends FormRequest
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
            'ten_phuong_thuc' => [
                'required',
                Rule::unique('phuong_thuc_thanh_toans', 'ten_phuong_thuc')->whereNull('deleted_at')->ignore($this->route('phuongthucthanhtoan'))
            ],
            'trang_thai' => ''
        ];
    }

    public function messages(): array
    {
        return [
            'ten_phuong_thuc.required' => 'Vui lòng nhập tên phương thức',
            'ten_phuong_thuc.unique' => 'Tên phương thức này đã tồn tại vui lòng nhập khác',
        ];
    }
}
