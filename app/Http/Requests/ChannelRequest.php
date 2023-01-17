<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ChannelRequest extends FormRequest
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
                'type' => ['nullable', 'string', 'in:direct,indirect'],
                'roles.*' => ['nullable', 'exists:roles,id'],
                'companies.*' => ['nullable', 'exists:companies,id'],
                'active' => ['nullable', 'in:0,1']
            ];
        } else {
            $rules = [
                'type' => ['required', 'string', 'in:direct,indirect'],
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
            'type.in' => 'value must be direct or indirect',
        ];
    }
}