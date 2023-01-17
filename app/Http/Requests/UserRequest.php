<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;
use Auth;

class UserRequest extends FormRequest
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
                'first_name' => ['nullable', 'min:3', 'max:50'],
                'last_name' => ['nullable', 'min:3', 'max:50'],
                'email' => ['nullable', 'string', 'email', 'max:255',  Rule::unique('users')->ignore(Request()->id ?? auth::id())],
                'phone' => ['nullable', 'numeric',  Rule::unique('users')->ignore(Request()->id ?? auth::id())],
                'password' => ['nullable', 'string', 'min:6'],
                'role' => ['nullable', 'exists:roles,id'],
                'companies.*' => ['nullable', 'exists:companies,id'],
                'active' => ['nullable', 'in:0,1'],
            ];
        } else {
            $rules = [
                'first_name' => ['string', 'required', 'min:3', 'max:30'],
                'profile_photo' => ['nullable',  "mimes:jpeg,bmp,png,jpg", 'image', 'file'],
                'last_name' => ['string', 'required', 'min:3', 'max:30'],
                'job_title' => ['string', 'required', 'min:2', 'max:30'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                'phone' => ['required', 'numeric', 'unique:users'],
                'password' => ['required', 'string', 'min:6', 'confirmed'],
                'role' => ['required', 'exists:roles,id'],
                'companies.*' => ['required', 'exists:companies,id'],
                'active' => ['nullable', 'in:0,1'],
            ];
        }
        return $rules;
    }
}