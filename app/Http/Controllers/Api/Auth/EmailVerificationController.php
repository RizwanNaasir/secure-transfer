<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\EmailVerificationApiRequest;
use App\Models\User;
use Illuminate\Auth\Events\Verified;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;

class EmailVerificationController extends Controller
{
    public function store(Request $request)
    {
        info('mess',[$request->all()]);
        $user = User::whereEmail($request->input('email'))->firstOrFail();

        if ($user->hasVerifiedEmail()) {
            return $this->success('Your is email already verified');
        }

        $user->sendEmailVerificationNotification();

        return $this->success('Verification link sent');
    }
}
