<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateGiaTriThuocTinhRequest extends FormRequest
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
           'thuoc_tinh_id' => 'required|exists:thuoc_tinhs,id',
        'gia_tri'       => 'required|string|max:255|unique:gia_tri_thuoc_tinhs,gia_tri,'. $this->giatrithuoctinh 
        ];
    }
    public function messages()
{
    return [
        'thuoc_tinh_id.required' => 'Vui lòng chọn một thuộc tính.',
        'thuoc_tinh_id.exists'   => 'Thuộc tính không hợp lệ.',
        'gia_tri.required'       => 'Giá trị thuộc tính không được để trống.',
        'gia_tri.string'         => 'Giá trị thuộc tính phải là chuỗi.',
        'gia_tri.max'            => 'Giá trị thuộc tính quá dài.',
        'gia_tri.unique'            => 'Giá trị thuộc tính không được trùng.',
    ];
}
}
