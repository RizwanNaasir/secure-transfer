<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Traits\CanResponseTrait;
use Illuminate\Support\Facades\Password;

class ResetPasswordController extends Controller
{
    use CanResponseTrait;

    public function send()
    {
        request()->validate([
            'email' => 'required|email',
        ]);
        $status = Password::sendResetLink(
            ['email' => request()->input('email')]
        );
        if ($status == Password::RESET_LINK_SENT) {
            return $this->success(
                message: 'Reset link sent to your email',
            );
        } else {
            return $this->error(
                message: $status,
            );
        }
    }
}
