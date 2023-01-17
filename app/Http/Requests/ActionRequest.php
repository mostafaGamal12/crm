<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ActionRequest extends FormRequest
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
                'action' => ['nullable', 'string', 'max:50'],
                'roles.*' => ['nullable', 'exists:roles,id'],
                'companies.*' => ['nullable', 'exists:companies,id'],
                'active' => ['nullable', 'in:0,1']
            ];
        } else {
            $rules = [
                'action' => ['required', 'string', 'max:50'],
                'roles.*' => ['required', 'exists:roles,id'],
                'companies.*' => ['required', 'exists:companies,id'],
                'active' => ['required', 'in:0,1']
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