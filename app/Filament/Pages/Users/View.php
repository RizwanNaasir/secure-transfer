<?php

namespace App\Filament\Pages\Users;

use App\Models\User;
use Filament\Pages\Page;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;

class View extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static string $view = 'filament.pages.users.view';

    protected static bool $shouldRegisterNavigation = false;

    public $user;

    /**
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    public function mount()
    {
        $this->user = User::find(request()?->get('user'));
    }

}


