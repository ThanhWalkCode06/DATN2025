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
            'name' => [
                'required',
            ],
            'name.*' => [
                'required',
                // 'regex:/^[^-]*-[^-]*$/',
                Rule::unique('permissions', 'name')->WhereNull('deleted_at')->ignore($this->route('permissions'))
            ],
            'description' => 'required',
            'description.*' => 'required',
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
            'name.unique' => 'Tên quyền này đã tồn tại',
            // 'name.*.regex' => 'Phải chứa dấu gạch (-) + chức năng và không được quá 1 dấu (-).',
        ];
    }
}
