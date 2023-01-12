<?php

namespace App\Http\Controllers;

use App\Models\User;
use Filament\Notifications\Notification;
use Filament\Notifications\Actions\Action;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function profile()
    {
//        Notification::make()->title('user')->warning()->persistent()->actions([

//            Action::make('varify')->button()
//        ])->send();
        return view(view: 'user.profile.index');
    }
    public function update(Request $request)
    {
        $user = User::whereId($request->input('id'))->first();

        if ($request->hasFile('avatar')) {
            $user->avatar = basename($request->file('avatar')->store('public'));
        }
        if ($request->hasFile('document1')) {
            $user->document1 = basename($request->file('document1')->store('public'));
        }
        if ($request->hasFile('document2')) {
            $user->document2 = basename($request->file('document2')->store('public'));
        }
        $user->save();
        return $this->success(['profile' => $user], message: 'Profile updated successfully');
    }

}
