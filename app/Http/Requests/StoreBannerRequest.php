<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreBannerRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    protected function prepareForValidation()
{
    $this->merge([
        'image_files' => $this->file('images'), // Tạo key tạm thời để dùng trong rule
    ]);
}

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            "do_uu_tien" => "required",
            'position'=> ['required'],
            'status' => ['required'],
            'start_date' => 'nullable',
            'end_date' => 'nullable| lt:start_date',
            // "title.*" => "required|max:50",
            // "content.*" => "required|max:50",
            // "descript.*" => "required|max:50",
            "loai_lien_ket.*" => "required",
            "images.*" => "required",
            'link_url' => ['max:100'],
            "require_image.*" => function ($attribute, $value, $fail) {
                preg_match('/require_image\.(\d+)/', $attribute, $matches);
                $index = $matches[1] ?? null;

                $imageFiles = $this->input('image_files');

                if (!isset($imageFiles[$index])) {
                    $fail('Ảnh là bắt buộc.');
                }
            },
        ];
    }

    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            $position = $this->input('position');
            $images = $this->file('images');
            $posit = [
                'secondary' => 'Banner phụ',
                'sidebar' => 'Banner sidebar',
            ];
            // dd($position,$images);
            if (in_array($position, ['secondary', 'sidebar']) && is_array($images) && count($images) > 1) {
                $validator->errors()->add('position', 'Vị trí "' . $posit[$position] . '" chỉ được chọn 1 ảnh.');
            }

            foreach ($this->input('loai_lien_ket') as $i => $loai) {
                if ($loai == 'sanpham' && empty($this->input("sanpham.$i"))) {
                    $validator->errors()->add("sanpham.$i", 'Vui lòng chọn sản phẩm phù hợp.');
                }
                if ($loai == 'danhmuc' && empty($this->input("danhmuc.$i"))) {
                    $validator->errors()->add("danhmuc.$i", 'Vui lòng chọn danh mục phù hợp.');
                }
                if($loai == 'tuychinh' && empty($this->input("custom_url.$i"))){
                    $validator->errors()->add("custom_url.$i", 'Vui lòng nhập đường dẫn.');
                }
            }
        });
    }

    public function messages(){
        return [
            "do_uu_tien.required" => "Vui lòng nhập độ ưu tiên.",
            'end_date.lt' => 'Phải lớn hơn ngày bắt đầu.',
            "title.*.required" => "Vui lòng nhập tiêu đề.",
            "title.*.max" => "Vui lòng không nhập tiêu đề quá 20 ký tự.",
            "content.*.required" => "Vui lòng nhập nội dung.",
            "content.*.max" => "Vui lòng không nhập nội dung quá 20 ký tự.",
            "descript.*.required" => "Vui lòng nhập mô tả.",
            "descript.*.max" => "Vui lòng không mô tả nhập quá 20 ký tự.",

            "loai_lien_ket.*.required" => "Vui lòng chọn loại liên kết.",
            'link_url.max' => 'Không nhập đường dẫn quá 100 ký tự.',

            'custom_url.*.required' => 'Vui lòng nhập đường dẫn.',
            'custom_url.*.max' => 'Không nhập đường dẫn quá 100 ký tự.',

            'images.*.required' => 'Không được để trống ảnh.'

        ];

    }
}
