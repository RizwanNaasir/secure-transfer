<?php

namespace App\Filament\App\Resources\PayoutRequestResource\Pages;

use App\Filament\App\Resources\PayoutRequestResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreatePayoutRequest extends CreateRecord
{
    protected static string $resource = PayoutRequestResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['user_id'] = auth()->user()->id;
        return $data;
    }
}
