<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CancelPayoutRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'payout_request_id' => ['required', 'exists:payout_requests,id', function ($attribute, $value, $fail) {
                $payoutRequest = auth()->user()->payout()->find($value);
                if (!$payoutRequest) {
                    $fail('Payout request not found');
                }
                if ($payoutRequest->status !== 'pending') {
                    $fail('Payout request is not pending');
                }
            }],
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
