<?php

namespace App\Http\Requests;

use App\Models\broker;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class BrokerRequest extends FormRequest
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
                'owner_name' => ['nullable', 'string', 'max:50'],
                'company_name' => ['nullable', 'string', 'max:50', Rule::unique('brokers')->ignore(Request()->id)],
                'company_phone' => ['nullable', 'regex' . $phone_regex, 'max:11', 'min:10', Rule::unique('brokers')->ignore(Request()->id)],
                'company_email' => ['nullable', 'email', Rule::unique('brokers')->ignore(Request()->id)],
                'roles.*' => ['nullable', 'exists:roles,id'],
                'active' => ['nullable', 'in:0,1'],
                'commercial_register' => ['nullable', 'string', 'max:50'],
                'tax_card' => ['nullable', 'string', 'max:26'],
                'commission.*' =>  ['nullable',  'regex' . $regex],
                // 'projects.*' =>  ['nullable',  'exists:projects,id'],
                'companies.*' => ['nullable', 'exists:companies,id'],
            ];
        } else {
            $rules = [
                'owner_name' => ['required', 'string', 'max:50'],
                'company_name' => ['required', 'string', 'max:50', 'unique:brokers'],
                'company_phone' => ['required', 'regex' . $phone_regex, 'max:11', 'min:10', 'unique:brokers'],
                'company_email' => ['required', 'email', 'unique:brokers'],
                'roles.*' => ['required', 'exists:roles,id'],
                'active' => ['required', 'in:0,1'],
                'commercial_register' => ['required', 'string', 'max:50'],
                'tax_card' => ['required', 'string', 'max:26'],
                // 'commission' =>  ['required',  'regex' . $regex],
                'files.*' => ['nullable',  "mimes:pdf", 'file', 'max:' . broker::max_file_size],
                'companies.*' => ['required', 'exists:companies,id'],
            ];
        }
        return $rules;
    }
}