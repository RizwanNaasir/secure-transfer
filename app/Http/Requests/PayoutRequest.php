<?php

namespace App\Http\Requests;

use App\Traits\FailedValidation;
use Illuminate\Foundation\Http\FormRequest;

class PayoutRequest extends FormRequest
{
    use FailedValidation;
    public function rules(): array
    {
        return [
            'bank_detail_id' => ['required', 'exists:bank_details,id'],
            'amount' => ['nullable', 'string', function ($attribute, $value, $fail) {
            $user = auth()->user();
            if ($value > $user->balanceInt) {
                    $fail(' Amount must be less than or equal to your current balance: '.$user->balanceInt);
                }
            }],
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
