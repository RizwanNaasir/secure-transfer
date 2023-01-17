<?php

namespace App\Observers;

use App\Models\User;

class UserObserver
{
    public function created(User $user)
    {

    }

    public function updated(User $user): void
    {
        if ($user->wasChanged("email") or $user->isDirty("email")){
            $user->email_verified_at = null;
            $user->save();
        };
    }

    public function deleted(User $user)
    {
    }

    public function restored(User $user)
    {
    }

    public function forceDeleted(User $user)
    {
    }
}