<?php

namespace App\Http\Requests;

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
            'ten_thuoc_tinh' => 'required|max:255|unique:thuoc_tinhs,ten_thuoc_tinh,' .$this->thuoctinh,
            'updated_at'=>'date_format:Y-m-d'
        ];
    }

    public function messages(){
        return [
            'ten_thuoc_tinh.required' => 'Tên thuộc tính bắt buộc điền.',
            'ten_thuoc_tinh.max'      => 'Tên thuộc tính quá dài',
            'ten_thuoc_tinh.unique'      => 'Tên thuộc tính không được trùng',
        ];
    }
}
