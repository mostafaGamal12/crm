<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Client\Request;

class RoleRequest extends FormRequest
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
        $rules = [];
        if (in_array($this->method(), ['PUT', 'PATCH'])) {

            $rules = [

                'name' => ['required', 'min:3', 'max:50', Rule::unique('roles')->ignore(Request()->id)],
                'permissions' => ['required', 'array'],
                'permissions.*' => ['exists:permissions,id']
            ];
        } else {
            $rules = [
                'name' => ['required', 'min:3', 'max:50', 'unique:roles,name'],
                'permissions' => ['required', 'array'],
                'permissions.*' => ['exists:permissions,id']
            ];
        }
        return $rules;
    }
    public function messages()
    {
        return [
            'name.unique' => 'This Role exists',
        ];
    }
}