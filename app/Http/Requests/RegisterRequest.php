<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
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
            'username' => 'required|string|min:3|max:50',
            'phone' => 'required|string|regex:/^\d{7,20}$/|unique:access_links,phone',
        ];
    }

    public function messages(): array
    {
        return [
            'username.required' => 'Username is required.',
            'username.min' => 'Username must be at least 3 characters.',
            'phone.required' => 'Phone number is required.',
            'phone.regex' => 'Phone number must be at least 7 digits.',
            'phone.unique' => 'This phone number is already registered.',
        ];
    }
}
