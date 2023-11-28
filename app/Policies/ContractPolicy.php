<?php

namespace App\Policies;

use App\Http\Middleware\VerifyDocument;
use App\Models\Contract;
use App\Models\User;
use Filament\Notifications\Notification;
use Illuminate\Auth\Access\HandlesAuthorization;

class ContractPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user): bool
    {
        if ($user->isAdmin()){
            return true;
        }
        if (!$user->is_approved_by_admin ) {
            return false;
        }
        return true;
    }

    public function view(User $user, Contract $contract): bool
    {
        if ($user->isAdmin()){
            return true;
        }
        if (!$user->is_approved_by_admin ) {
            return false;
        }
        return true;
    }

    public function create(User $user): bool
    {
        if ($user->isAdmin()){
            return true;
        }
        if (!$user->is_approved_by_admin ) {
            return false;
        }
        return true;
    }

    public function update(User $user, Contract $contract): bool
    {
        if ($user->isAdmin()){
            return true;
        }
        if (!$user->is_approved_by_admin ) {
            return false;
        }
        return true;
    }

    public function delete(User $user, Contract $contract): bool
    {
        if ($user->isAdmin()){
            return true;
        }
        if (!$user->is_approved_by_admin ) {
            return false;
        }
        return true;
    }

    public function restore(User $user, Contract $contract): bool
    {
        if ($user->isAdmin()){
            return true;
        }
        if (!$user->is_approved_by_admin ) {
            return false;
        }
        return true;
    }

    public function forceDelete(User $user, Contract $contract): bool
    {
        if ($user->isAdmin()){
            return true;
        }
        if (!$user->is_approved_by_admin ) {
            return false;
        }
        return true;
    }
}