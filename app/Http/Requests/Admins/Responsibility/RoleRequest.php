<?php

namespace App\Http\Requests\Admins\Responsibility;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class RoleRequest extends FormRequest
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
                'required','max:255',
                Rule::unique('roles', 'name')->whereNull('deleted_at')->ignore($this->route('roles'))
            ],

        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Tên vai trò không được để trống.',
            'name.unique' => 'Tên vai trò này đã tồn tại',
            'name.max' => 'Tên vai trò chỉ được 255 ký tự',
        ];
    }
}
