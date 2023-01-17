<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;
use Auth;

class CountryRequest extends FormRequest
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
                'name' => ['nullable', 'min:3', 'max:50'],
                'companies.*' => ['nullable', 'exists:companies,id'],
            ];
        } else {
            $rules = [
                'name' => ['string', 'required', 'min:3', 'max:30'],
                 'companies.*' => ['required', 'exists:companies,id'],
            ];
        }
        return $rules;
    }
}
