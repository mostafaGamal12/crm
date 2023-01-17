<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class AmbassadorRequest extends FormRequest
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
        $regex = ":/^(?=.+)(?:[1-9]\d*|0)?(?:\.\d+)?$/";
        $phone_regex = ":/^(\+201|01|00201)[0-2,5]{1}[0-9]{8}/";
        if (in_array($this->method(), ['PUT', 'PATCH'])) {
            $rules = [
                'name' => ['nullable', 'string', 'max:50'],
                'phone' => ['nullable', 'regex' . $phone_regex, 'max:11', 'min:10', Rule::unique('ambassadors')->ignore(Request()->id)],
                'user_id' => ['nullable', 'exists:users,id'],
                'roles.*' => ['nullable', 'exists:roles,id'],
                'active' => ['nullable', 'in:0,1'],
                'job_title' => ['nullable', 'string', 'max:50'],
                'company' => ['nullable', 'string', 'max:50'],
                'id_number' => ['nullable', 'string', 'max:26'],
                'commission' =>  ['nullable',  'regex' . $regex],
                'companies.*' => ['nullable', 'exists:companies,id'],
            ];
        } else {
            $rules = [
                'name' => ['required', 'string', 'max:50'],
                'phone' => ['required', 'regex' . $phone_regex, 'max:11', 'min:10', 'unique:ambassadors'],
                'user_id' => ['required', 'exists:users,id'],
                'roles.*' => ['required', 'exists:roles,id'],
                'active' => ['required', 'in:0,1'],
                'job_title' => ['nullable', 'string', 'max:50'],
                'company' => ['nullable', 'string', 'max:50'],
                'id_number' => ['nullable', 'string', 'max:26'],
                'id_photo' =>  ['nullable',  "mimes:jpeg,bmp,png,jpg", 'image', 'file'],
                'commission' =>  ['nullable',  'regex' . $regex],
                'companies.*' => ['required', 'exists:companies,id'],
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