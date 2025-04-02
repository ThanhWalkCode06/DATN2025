<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use Illuminate\Foundation\Http\FormRequest;

class UpdateThuocTinhRequest extends FormRequest
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
            'ten_thuoc_tinh' => [
                'required',
                'max:255',
                Rule::unique('thuoc_tinhs', 'ten_thuoc_tinh')
                    ->whereNull('deleted_at')
                    ->ignore($this->route('thuoctinh')),
            ],
            'updated_at' => 'date_format:Y-m-d',
            'gia_tri' => 'required|array|min:1', // Phải có ít nhất một giá trị
            'gia_tri.*' => [
                'required', // Không được bỏ trống
                'string', // Đảm bảo là chuỗi
                // 'distinct', // Không cho phép trùng trong request
                // function ($attribute, $value, $fail) {
                //     $thuocTinhId = request()->route('thuoctinh');

                //     // Lấy danh sách ID của giá trị thuộc tính từ request
                //     $giaTriIds = request()->input('gia_tri_id', []);

                //     // Tìm ID của giá trị thuộc tính hiện tại
                //     preg_match('/\d+/', $attribute, $matches);
                //     $index = $matches[0] ?? null;

                //     $giaTriId = $giaTriIds[$index] ?? null;

                //     // Kiểm tra trùng, bỏ qua chính nó
                //     $exists = DB::table('gia_tri_thuoc_tinhs')
                //         ->where('gia_tri', $value)
                //         ->whereNull('deleted_at')
                //         ->where('thuoc_tinh_id', $thuocTinhId)
                //         ->when($giaTriId, function ($query) use ($giaTriId) {
                //             return $query->where('id', '!=', $giaTriId);
                //         })
                //         ->exists();

                //     if ($exists) {
                //         $fail('Giá trị thuộc tính "' . $value . '" đã tồn tại.');
                //     }
                // }


            ],
        ];
    }


    public function messages()
    {
        return [
            'ten_thuoc_tinh.required' => 'Tên thuộc tính bắt buộc điền.',
            'ten_thuoc_tinh.max'      => 'Tên thuộc tính quá dài.',
            'ten_thuoc_tinh.unique'   => 'Tên thuộc tính đã tồn tại.',
            'gia_tri.required'        => 'Phải có ít nhất một giá trị thuộc tính.',
            'gia_tri.array'           => 'Giá trị thuộc tính phải là mảng.',
            'gia_tri.min'             => 'Phải nhập ít nhất một giá trị thuộc tính.',
            'gia_tri.*.required'      => 'Giá trị thuộc tính không được để trống.',
            'gia_tri.*.string'        => 'Giá trị thuộc tính phải là chuỗi hợp lệ.',
            'gia_tri.*.distinct'      => 'Giá trị thuộc tính không được trùng nhau.',
        ];
    }


}
