<?php

namespace App\Http\Requests;

use App\Traits\CanResponseTrait;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class ContractRequest extends FormRequest
{

    use CanResponseTrait;
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            'email' => 'required',
            'amount' => 'required',
            'description' => 'required',
            'file' => 'required|file',
            'preferred_payment_method' => 'required',
        ];
    }
    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException($this->error(message: $validator->errors()->first()));
    }

}
