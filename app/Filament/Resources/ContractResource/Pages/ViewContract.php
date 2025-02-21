<?php

namespace App\Filament\Resources\ContractResource\Pages;

use App\Filament\Resources\ContractResource;
use App\Models\User;
use Filament\Actions\Action;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ViewRecord;
use Illuminate\Notifications\Notification;

class ViewContract extends ViewRecord
{
    protected static string $resource = ContractResource::class;

    protected function getHeaderActions(): array
    {
       return [
           Actions\Action::make('approved request')
               ->requiresConfirmation()
               ->action(function (){
                   $user = $this->record->recipient->first();
                   $amount = $this->record->amount;
                   $user->deposit($amount);
                   \Filament\Notifications\Notification::make()
                       ->title('Payment Approved')
                       ->body('Payment released successfully')
                       ->success()
                       ->send();
               })
       ];
    }
}
