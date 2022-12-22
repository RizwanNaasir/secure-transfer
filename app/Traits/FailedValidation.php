<?php

namespace App\Traits;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

trait FailedValidation
{
    use CanResponseTrait;
    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(
            $this->error(
                message: $validator->errors()->first(),
                code: 422
            )
        );
    }
}