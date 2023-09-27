<?php

namespace App\Filament\App\Resources\ContractResource\Pages;

use App\Filament\App\Resources\ContractResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditContract extends EditRecord
{
    protected static string $resource = ContractResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    protected function afterFill(): void
    {
        $this->form->fill([
            'email' => $this->record->recipient->first()->email ?? '',
            ...$this->form->model->getAttributes()
        ]);
    }
}
