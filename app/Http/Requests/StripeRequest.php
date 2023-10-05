<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

class StripeRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'amount' => 'required|string|max:255|unique:users',
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
