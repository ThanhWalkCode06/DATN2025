<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreSanPhamRequest extends FormRequest
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
        'ten_san_pham' => 'required|string|max:255',  
        'ma_san_pham' => 'required|string|max:255|unique:san_phams',  
        'khuyen_mai' => 'nullable|numeric',  
        'hinh_anh' => 'nullable|image|max:2048',  
        'mo_ta' => 'nullable|string',  
        'danh_muc_id' => 'required|exists:danh_muc_san_phams,id',  // Sửa tên bảng thành danh_muc_san_phams  
        'trang_thai' => 'boolean'  
    ];  
}
    public function messages(): array
    {
        return [
            'ten_san_pham.required' => 'Tên sản phẩm không được để trống.',
            'ma_san_pham.required' => 'Mã sản phẩm không được để trống.',
            'ma_san_pham.unique' => 'Mã sản phẩm đã tồn tại.',
            'danh_muc_id.required' => 'Danh mục sản phẩm không được để trống.',
            'danh_muc_id.exists' => 'Danh mục sản phẩm không hợp lệ.',
            'trang_thai.boolean' => 'Trạng thái phải là giá trị đúng hoặc sai.'
        ];
    }
}
