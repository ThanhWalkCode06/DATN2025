<?php

namespace App\Http\Requests;

use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
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
        'anh_bien_the' => 'nullable|array',
        'anh_bien_the.*' => 'nullable|image',
        'ten_san_pham' => 'required|string|max:255',
        'ma_san_pham' => 'required|string|unique:san_phams,ma_san_pham',
        // 'khuyen_mai' => 'nullable|numeric|min:0',
        'gia_cu' => ['required', 'numeric','min:1'],
        'gia_moi' => ['required', 'numeric','min:0','lt:gia_cu'],
        'mo_ta' => 'nullable|string',

        'hinh_anh' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',

        'danh_muc_id' => 'required|exists:danh_muc_san_phams,id',
        'trang_thai' => 'required|boolean',

        'gia_nhap' => [ 'array'],
        'gia_nhap.*' => ['required', 'numeric','min:0'],
        'gia_ban' => [ 'array'],
        'gia_ban.*' => ['required', 'numeric','min:0'],
        'so_luong' => [ 'array'],
        'so_luong.*' => ['required', 'integer','min:0'],



        // 'thuoc_tinh_id.*' => 'nullable|exists:thuoc_tinhs,id',
        // 'attribute_values.*' => 'nullable|exists:gia_tri_thuoc_tinhs,id',
        ];
    }

    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            $gia_nhap = $this->input('gia_nhap', []);
            $gia_ban = $this->input('gia_ban', []);

            foreach ($gia_nhap as $index => $value) {
                if (isset($gia_ban[$index]) && $value >= $gia_ban[$index]) {
                    $validator->errors()->add("gia_nhap.$index", "Giá nhập phải nhỏ hơn giá bán.");
                }
            }
        });
        if ($this->hasFile('hinh_anh')) {
            $file = $this->file('hinh_anh');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $hinhAnhPath = $file->storeAs('uploads/sanphams', $fileName, 'public'); // Lưu file vào storage/app/public/uploads/sanphams/

            Session::put('temp_image', $hinhAnhPath);

        }
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

            'gia_nhap.*.required' => 'Bắt buộc phải nhập',
            'gia_nhap.*.numeric' => 'Bắt buộc phải nhập số',
            'gia_nhap.*.min' => 'Bắt buộc nhỏ hơn giá bạn',

            'gia_ban.*.required' => 'Bắt buộc phải nhập',
            'gia_ban.*.numeric' => 'Bắt buộc phải nhập số',
            'gia_ban.*.min' => 'Bắt buộc nhỏ hơn giá bạn',


            'so_luong.*.required' => 'Bắt buộc phải nhập',
            'anh_bien_the.*.required' => 'Bắt buộc phải nhập',
            'anh_bien_the.required' => 'Bắt buộc phải nhập',
            'hinh_anh.required' => 'Bắt buộc phải nhập',

        ];
    }
}
