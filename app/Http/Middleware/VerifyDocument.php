<?php

namespace App\Http\Middleware;

use Closure;
use Filament\Notifications\Notification;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\URL;

class VerifyDocument
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if ( auth()->user() &&
            !auth()->user()->is_approved_by_admin ) {
            if ($request->expectsJson()) {
                return abort(403, 'Your profile is incomplete.');
            }
            Notification::make()
                ->title('Verification Required')
                ->body('Admin verify your document. you will get response in 48 hours')
                ->warning()
                ->send();
            return \redirect('/');
        }
        return $next($request);
    }
}
