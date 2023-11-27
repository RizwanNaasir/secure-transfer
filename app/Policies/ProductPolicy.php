<?php

namespace App\Policies;

use App\Models\Product;
use App\Models\User;
use Filament\Notifications\Notification;
use Illuminate\Auth\Access\HandlesAuthorization;

class ProductPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user): bool
    {
        $document1 = $user->getFirstMediaUrl(User::DOCUMENTS_COLLECTION1);
        $document2 = $user->getFirstMediaUrl(User::DOCUMENTS_COLLECTION2);
        if ($user->isAdmin()){
            return true;
        }
        if (blank($document1) && blank($document2))
        {
            Notification::make()
                ->title('Documents')
                ->body('Upload your document firstly')
                ->warning()
                ->send();
        }
        if (!$user->is_approved_by_admin ) {
            Notification::make()
                ->title('Verification Required')
                ->body('Admin verify your document. you will get response in 48 hours')
                ->warning()
                ->send();
            return false;
        }
        return true;
    }

    public function view(User $user, Product $product): bool
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

    public function update(User $user, Product $product): bool
    {
        if ($user->isAdmin()){
            return true;
        }
        if (!$user->is_approved_by_admin ) {
            return false;
        }
        return true;
    }

    public function delete(User $user, Product $product): bool
    {
        if ($user->isAdmin()){
            return true;
        }
        if (!$user->is_approved_by_admin ) {
            return false;
        }
        return true;
    }

    public function restore(User $user, Product $product): bool
    {
        if ($user->isAdmin()){
            return true;
        }
        if (!$user->is_approved_by_admin ) {
            return false;
        }
        return true;
    }

    public function forceDelete(User $user, Product $product): bool
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
