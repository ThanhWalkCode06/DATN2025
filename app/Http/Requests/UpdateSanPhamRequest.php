<?php

namespace App\Http\Requests;

use Illuminate\Support\Facades\Session;
use Illuminate\Foundation\Http\FormRequest;

class UpdateSanPhamRequest extends FormRequest
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
            // 'ma_san_pham' => 'required|string|max:255|unique:san_phams,ma_san_pham,',
            'ma_san_pham' => 'required|string|max:255|unique:san_phams,ma_san_pham,' . $this->route('sanpham') . ',id',
            'khuyen_mai' => 'nullable|numeric|min:0',
            'mo_ta' => 'nullable|string',
            'danh_muc_id' => 'required|exists:danh_muc_san_phams,id',
            'trang_thai' => 'required|boolean',
            'hinh_anh' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',


            'gia_cu' => ['required', 'numeric','min:1'],
            'gia_moi' => ['required', 'numeric','min:0','lt:gia_cu'],
            'anh_bien_the' => 'nullable|array',
            'anh_bien_the.*' => 'nullable|image',
            'gia_nhap' => [ 'array'],
            'gia_nhap.*' => ['required', 'numeric','min:0'],
            'gia_ban' => [ 'array'],
            'gia_ban.*' => ['required', 'numeric','min:0'],
            'so_luong' => [ 'array'],
            'so_luong.*' => ['required', 'integer','min:0'],
        ];
    }

    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            $gia_nhap = $this->input('gia_nhap', []);
            $gia_ban = $this->input('gia_ban', []);
            $gia_cu = $this->input('gia_cu');
            // dd($gia_cu);
            foreach ($gia_nhap as $index => $value) {
                if (isset($gia_nhap[$index]) && $value >= $gia_ban[$index]) {
                    $validator->errors()->add("gia_nhap.$index", "Giá nhập phải nhỏ hơn giá bán.");
                }
                if($value >= $gia_cu){
                    $validator->errors()->add("gia_nhap.$index", "Giá nhập phải nhỏ hơn giá cũ.");
                }
                if($gia_ban[$index] >= $gia_cu){
                    $validator->errors()->add("gia_ban.$index", "Giá bán phải nhỏ hơn giá cũ.");
                }
            }
            // dd($validator->errors()->all());
        });
        if ($this->hasFile('hinh_anh')) {
            $file = $this->file('hinh_anh');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $hinhAnhPath = $file->storeAs('uploads/sanphams', $fileName, 'public'); // Lưu file vào storage/app/public/uploads/sanphams/

            Session::put('temp_image', $hinhAnhPath);

        }
    }

    /**
     * Get the validation error messages.
     *
     * @return array
     */
    public function messages(): array
    {
        return [
            'ten_san_pham.required' => 'Tên sản phẩm không được để trống.',
            'ten_san_pham.max' => 'Tên sản phẩm không được vượt quá 255 ký tự.',
            'ma_san_pham.required' => 'Mã sản phẩm không được để trống.',
            'ma_san_pham.string' => 'Mã sản phẩm phải là chuỗi.',
            'ma_san_pham.unique' => 'Mã sản phẩm ' . $this->ma_san_pham . ' đã tồn tại.',
            'khuyen_mai.numeric' => 'Khuyến mãi phải là một số.',
            'khuyen_mai.min' => 'Khuyến mãi phải lớn hơn hoặc bằng 0.',
            'danh_muc_id.required' => 'Danh mục không được để trống.',
            'danh_muc_id.exists' => 'Danh mục này không tồn tại.',
            'trang_thai.required' => 'Trạng thái không được để trống.',
            'trang_thai.boolean' => 'Trạng thái phải là còn hàng hoặc hết hàng.',
            'hinh_anh.image' => 'Hình ảnh phải là tệp hình ảnh.',
            'hinh_anh.mimes' => 'Hình ảnh phải có định dạng jpeg, png, jpg, hoặc gif.',
            'hinh_anh.max' => 'Hình ảnh không được vượt quá 2MB.',

            'gia_nhap.*.required' => 'Bắt buộc phải nhập',
            'gia_nhap.*.numeric' => 'Bắt buộc phải nhập số',
            'gia_nhap.*.min' => 'Bắt buộc lớn hơn 0',
            'gia_moi.lt' =>'Giá mới phải ít hơn giá cũ',
            'gia_moi.required' =>'Bắt buộc phải nhập',
            'gia_cu.required' =>'Bắt buộc phải nhập',

            'gia_ban.*.required' => 'Bắt buộc phải nhập',
            'gia_ban.*.numeric' => 'Bắt buộc phải nhập số',
            'gia_ban.*.min' => 'Bắt buộc lớn hơn 0',


            'so_luong.*.required' => 'Bắt buộc phải nhập',
            'so_luong.*.min' => 'Bắt buộc lớn hơn hoặc bằng 0',
            'anh_bien_the.*.required' => 'Bắt buộc phải nhập',
            'anh_bien_the.required' => 'Bắt buộc phải nhập',
            'hinh_anh.required' => 'Bắt buộc phải nhập',
        ];
    }
}
