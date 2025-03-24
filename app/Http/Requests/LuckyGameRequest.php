<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LuckyGameRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'token' => 'required|string|exists:access_links,token',
        ];
    }

    public function messages(): array
    {
        return [
            'token.required' => 'Token is required.',
            'token.string' => 'Token must be a valid string.',
            'token.exists' => 'Invalid or expired token.',
        ];
    }
}
