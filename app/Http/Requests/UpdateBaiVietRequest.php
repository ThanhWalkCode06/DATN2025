<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateBaiVietRequest extends FormRequest
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
            'user_id' => 'required|exists:users,id',
            'tieu_de' => 'required|string|max:255|unique:bai_viets,tieu_de,' . $this->baiviet,
            'danh_muc_id' => 'required|exists:danh_muc_bai_viets,id',
            'noi_dung' => 'required',
            'anh_bia' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ];
    }

    public function messages(){
       return [
        'user_id.required' => 'Vui lòng chọn tài khoản người viết.',
        'user_id.exists' => 'Tài khoản không tồn tại.',
        'tieu_de.required' => 'Tiêu đề bài viết là bắt buộc.',
        'tieu_de.unique' => 'Tiêu đề bài viết đã tồn tại. Vui lòng nhập tiêu đề khác.',
        'danh_muc_id.required' => 'Danh mục bài viết là bắt buộc.',
        'danh_muc_id.exists' => 'Danh mục không tồn tại.',
        'noi_dung.required' => 'Nội dung bài viết không được để trống.',
        'anh_bia.image' => 'Tệp tải lên phải là hình ảnh.',
        'anh_bia.required' => 'Hình ảnh không được để trống.',
        'anh_bia.mimes' => 'Hình ảnh phải có định dạng jpeg, png, jpg hoặc gif.',
        'anh_bia.max' => 'Hình ảnh không được vượt quá 2MB'
       ];
    }
}


