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
            $actions = [
                Actions\Action::make('accept_contract')
                    ->color('success')
                    ->requiresConfirmation()
                    ->modalDescription('Scan the QR code with your phone to accept the contract')
                    ->action(function () {
                        $product_owner  = $this->record->recipient->first();
                        $amount = $this->record->amount;
                        ContractService::updateContract(contract: $this->record, status: 'accepted');
                        if ($this->record->preferred_payment_method === 'wallet')
                        {
                            $product_owner->deposit($amount);
                        }

                    }),

                Actions\Action::make('cancel_contract')
                    ->color('danger')
                    ->requiresConfirmation()
                    ->modalDescription('Are you sure you want to cancel this contract?')
                    ->action(function () {
                        $contract_send_owner  = $this->record->user->first();
                        $amount = $this->record->amount;
                        ContractService::updateContract(contract: $this->record, status: 'accepted');
                        if ($this->record->preferred_payment_method === 'wallet')
                        {
                            $contract_send_owner->deposit($amount, meta: ['description' => 'Contract cancelled']);
                        }

                    })
            ];
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
