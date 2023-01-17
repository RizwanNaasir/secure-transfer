<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\EmailVerificationApiRequest;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Filament\Notifications\Notification;
use Illuminate\Auth\Events\Verified;
use Illuminate\Foundation\Auth\EmailVerificationRequest;

class VerifyEmailController extends Controller
{
    public function __invoke(EmailVerificationApiRequest $request)
    {
        $user = User::findOrFail(request()->id);
        if ($user->hasVerifiedEmail()) {
            if (!request()->expectsJson()) {
                Notification::make()
                    ->title('Email Already Verified')
                    ->warning()
                    ->send();
                return redirect()->intended(RouteServiceProvider::HOME . '?verified=1');
            } else {
                return $this->success('Your is email already verified');
            }
        }
        event(new Verified($user));
        if ($user->markEmailAsVerified()) {
            if (!request()->expectsJson()) {
                Notification::make()
                    ->title('Email Verified')
                    ->success()
                    ->send();
            }
            return redirect()->intended(RouteServiceProvider::HOME . '?verified=1');
        } else {
            return $this->success('Your email is successfully verified');
        }

    }
}
