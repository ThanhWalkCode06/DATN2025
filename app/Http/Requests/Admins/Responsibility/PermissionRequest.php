<?php

namespace App\Http\Requests\Admins\Responsibility;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class PermissionRequest extends FormRequest
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
            'name' => 'required|array',
            'name.*' => [
                'required',
                'regex:/^[^-]*_[^-]*$/',
                Rule::unique('permissions', 'name')->ignore($this->route('permission'))
            ],
            'description' => 'required|array',
            'description.*' => 'required|string',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Tên quyền không được để trống.',
            'name.*.required' => 'Tên quyền không được để trống.',
            'description.required' => 'Mô tả quyền không được để trống.',
            'description.*.required' => 'Mô tả quyền không được để trống.',
            'name.*.unique' => 'Tên quyền này đã tồn tại',
            'name.*.regex' => 'Tên phải chứa dấu gạch (-) + chức năng.'
        ];
    }
}
