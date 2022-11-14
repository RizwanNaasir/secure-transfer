<?php

namespace App\Http\Controllers;

use Filament\Notifications\Notification;
use Filament\Notifications\Actions\Action;

class UserController extends Controller
{
    public function profile()
    {
//        Notification::make()->title('user')->warning()->persistent()->actions([

//            Action::make('varify')->button()
//        ])->send();
        return view(view: 'user.profile.index');
    }
}
