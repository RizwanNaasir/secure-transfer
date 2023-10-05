<?php

namespace App\Filament\App\Resources\PayoutRequestResource\Pages;

use App\Filament\App\Resources\PayoutRequestResource;
use App\Models\PayoutRequest;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditPayoutRequest extends EditRecord
{
    protected static string $resource = PayoutRequestResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make()->hidden(function (PayoutRequest $payoutRequest) {
                return $payoutRequest->status !== 'pending';
            }),
        ];
    }
}
