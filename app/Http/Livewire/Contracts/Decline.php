<?php

namespace App\Http\Livewire\Contracts;

use App\Models\Contract;
use App\Services\ContractService;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Notifications\Notification;
use LivewireUI\Modal\ModalComponent;

class Decline extends ModalComponent implements HasForms
{
    use InteractsWithForms;

    public string $description = '';

    public function render()
    {
        return view('livewire.contracts.decline');
    }
    protected function getFormSchema(): array
    {
        return [
            Textarea::make('description')->disableLabel()
        ];
    }

    public function submit()
    {
        $contract = Contract::query()->where(['id' => session()->get('contract_id')])
            ->firstOrFail();
        ContractService::updateContract($contract,'declined',$this->description);
        Notification::make()
            ->title('Contract declined')
            ->body('Contract declined successfully')
            ->success()
            ->send();
        $this->closeModal();
    }
}
