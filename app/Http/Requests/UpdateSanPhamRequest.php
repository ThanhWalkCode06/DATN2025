<?php  

namespace App\Http\Requests;  

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
        ];  
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
        ];  
    }    
}