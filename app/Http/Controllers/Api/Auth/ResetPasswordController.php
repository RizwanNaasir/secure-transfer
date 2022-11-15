<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\PasswordResetRequest;
use App\Traits\CanResponseTrait;
use Illuminate\Support\Facades\Password;

class ResetPasswordController extends Controller
{
    use CanResponseTrait;

    public function send(PasswordResetRequest $request)
    {
        $status = Password::sendResetLink(
            ['email' => $request->input('email')]
        );
        if ($status === Password::RESET_LINK_SENT) {
            return $this->success(
                data: [],
                message: 'Reset link sent to your email'
            );
        } else {
            return $this->error(
                message: $status,
            );
        }
    }
}
