<?php

namespace App\Filament\Resources\PayoutRequestResource\Pages;

use _PHPStan_7c8075089\Symfony\Component\Console\Color;
use App\Filament\Resources\PayoutRequestResource;
use Filament\Actions;
use Filament\Actions\Action;
use Filament\Resources\Pages\ViewRecord;
use Filament\Support\View\Components\Modal;

class ViewPayoutRequest extends ViewRecord
{
    protected static string $resource = PayoutRequestResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Action::make('Approve')
                ->color('success')
                ->requiresConfirmation()
                ->modalHeading('Approve Payout Request')
                ->action(function ($record) {
                    $record->status = 'approved';
                    $record->user->withdraw($record->amount);
                    $record->save();
                })
            ->hidden(fn ($record) => $record->status !== 'pending'),

            Action::make('Decline')
                ->color('danger')
                ->requiresConfirmation()
                ->modalHeading('Decline Payout Request')
                ->action(function ($record) {
                    $record->status = 'declined';
                    $record->save();
                })
                ->hidden(fn ($record) => $record->status !== 'pending'),
        ];
    }
}
