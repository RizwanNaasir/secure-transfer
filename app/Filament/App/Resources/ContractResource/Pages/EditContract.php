<?php

namespace App\Filament\App\Resources\ContractResource\Pages;

use App\Filament\App\Resources\ContractResource;
use App\Models\Contract;
use App\Services\ContractService;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Support\Facades\DB;

/**
 * @property Contract $record
 */
class EditContract extends EditRecord
{
    protected static string $resource = ContractResource::class;

    protected function getHeaderActions(): array
    {
        $actions = [];
        $contractIsReceived = DB::table('contract_user')
            ->where('contract_id', $this->record->id)
            ->where('recipient_id', auth()->id())
            ->exists();

        if ($contractIsReceived && $this->record->is_pending) {
            $actions[] = Actions\Action::make('accept_contract')
                ->requiresConfirmation()
                ->modalDescription('Scan the QR code with your phone to accept the contract')
                ->action(function () {
                    ContractService::updateContract(contract: $this->record, status: 'accepted');
                });
        } else {
            Actions\DeleteAction::make();
        }
        return $actions;
    }

    protected function afterFill(): void
    {
        $this->form->fill([
            'email' => $this->record->recipient->first()->email ?? '',
            ...$this->form->model->getAttributes()
        ]);
    }
}
