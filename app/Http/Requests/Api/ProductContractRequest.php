<?php

namespace App\Http\Requests\Api;

use App\Traits\FailedValidation;
use Illuminate\Foundation\Http\FormRequest;

class ProductContractRequest extends FormRequest
{
    use FailedValidation;

    public function rules(): array
    {
        return [
            'product_id' =>  'required|exists:products,id',
            'preferred_payment_method' => 'required'
        ];
    }
}