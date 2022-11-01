<?php

namespace App\Http\Middleware;

use Filament\Notifications\Notification;
use Illuminate\Auth\Middleware\Authenticate as Middleware;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    protected function redirectTo($request)
    {
        if (! $request->expectsJson()) {
            Notification::make()
                ->title('Authentication Required')
                ->body('You need to login before you can perform any actions.')
                ->warning()
                ->send();
            return route('/');
        }
    }
}
