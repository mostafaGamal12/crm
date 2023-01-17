<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class CompanyRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        if (in_array($this->method(), ['PUT', 'PATCH'])) {
            $rules = [
                'name' => ['nullable', 'string', 'max:50', Rule::unique('companies')->ignore(Request()->id)],
                'parent_id' => ['nullable', 'exists:companies,id'],
                'active' => ['nullable', 'in:0,1'],
            ];
        } else {
            $rules = [
                'name' => ['required', 'string', 'max:50', 'unique:companies'],
                'parent_id' => ['nullable', 'exists:companies,id'],
                'active' => ['nullable', 'in:0,1'],
            ];
        }
        return $rules;
    }

    public function messages()
    {
        return [
            'active.in' => 'value must be 0 or 1',
        ];
    }
}