<?php

namespace App\Filament\App\Pages;

use App\Models\User;
use Filament\Actions\Action;
use Filament\Actions\CreateAction;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Pages\Page;
use Filament\Tables\Columns\TextColumn;

class Wallet extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-wallet';

    protected static string $view = 'filament.app.pages.wallet';
    protected static ?int $navigationSort = 1;


    protected function getActions(): array
    {
       return [];
    }

    public function mount()
    {
       $user = auth()->user();
       if (!$user->is_approved_by_admin)
       {
           $this->redirect('/panel/users/' . $user->id.'/edit');
       }
    }

}
