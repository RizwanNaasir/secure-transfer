<?php

namespace App\Http\Requests;

use App\Traits\FailedValidation;
use Illuminate\Foundation\Http\FormRequest;

class BankDetailRequest extends FormRequest
{
    use FailedValidation;
    public function rules(): array
    {
        return [
            'account_holder_name' => ['required','string'],
            'bank_name' => ['required','string'],
            'account_number' => ['required','string'],
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
