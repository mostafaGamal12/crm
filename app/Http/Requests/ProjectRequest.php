<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;
use Auth;

class ProjectRequest extends FormRequest
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
                'name'                    => ['nullable', 'min:3', 'max:30'],
                'description'             => ['nullable', 'min:3', 'max:200'],
                'country_id'              => ['nullable', 'exists:countries,id'],
                'governorate_id'          => ['nullable', 'exists:governorates,id'],
                'city_id'                 => ['nullable', 'exists:cities,id'],
                'district_id'             => ['nullable', 'exists:districts,id'],
                'features.*'              => ['nullable', 'exists:project_features,id'],
                'types.*'                 => ['nullable', 'exists:project_types,id'],
                'location'                => ['nullable', 'min:3', 'max:100'],
                'map_url'                 => ['nullable', 'min:3', 'max:100'],
                'area'                    => ['nullable', 'min:3', 'max:50'],
                'down_payment'            => ['nullable', 'min:3', 'max:50'],
                'commission_per_million'  => ['nullable', 'min:3', 'max:50'],
                 'companies.*' => ['nullable', 'exists:companies,id'],
            ];
        } else {
            $rules = [
                'name'                    => ['string', 'required', 'min:3', 'max:30'],
                'description'             => ['string', 'required', 'min:3', 'max:200'],
                'country_id'              => ['required', 'exists:countries,id'],
                'governorate_id'          => ['required', 'exists:governorates,id'],
                'city_id'                 => ['required', 'exists:cities,id'],
                'district_id'             => ['required', 'exists:districts,id'],
                'features.*'              => ['required', 'exists:project_features,id'],
                'types.*'                 => ['required', 'exists:project_types,id'],
                'location'                => ['string', 'nullable', 'min:3', 'max:100'],
                'map_url'                 => ['nullable', 'min:3', 'max:100'],
                'area'                    => ['nullable', 'min:3', 'max:50'],
                'down_payment'            => ['nullable', 'min:3', 'max:50'],
                'commission_per_million'  => ['nullable', 'min:3', 'max:50'],
                'companies.*' => ['required', 'exists:companies,id'],
            ];
        }
        return $rules;
    }
}
