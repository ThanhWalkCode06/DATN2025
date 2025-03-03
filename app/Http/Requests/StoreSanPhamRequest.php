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
    public function rules()
    {
        return [
            'ten_san_pham' => 'required|string|max:255',
            'ma_san_pham' => 'required|string|unique:san_phams,ma_san_pham',
            'khuyen_mai' => 'nullable|numeric|min:0',
            'mo_ta' => 'nullable|string',
            'hinh_anh' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'danh_muc_id' => 'required|exists:danh_muc_san_phams,id',
            'trang_thai' => 'required|boolean',
    
            // Validate biến thể
            'ten_bien_the.*' => 'required|string',
            'gia_nhap.*' => 'required|numeric|min:0',
            'gia_ban.*' => 'required|numeric|min:0',
            'so_luong.*' => 'required|integer|min:0',
            'thuoc_tinh_id.*' => 'nullable|exists:thuoc_tinhs,id',
            'gia_tri_thuoc_tinh.*' => 'nullable|exists:gia_tri_thuoc_tinhs,id',
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
            'trang_thai.boolean' => 'Trạng thái phải là còn hàng hoặc hết hàng.',

            
        ];
    }
}
