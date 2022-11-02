<?php

namespace App\Http\Livewire\Contracts;

use App\Models\Contract;
use App\Services\ContractService;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Notifications\Notification;
use LivewireUI\Modal\ModalComponent;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;

class Accept extends ModalComponent implements HasForms
{
    use InteractsWithForms;


    public function getFormSchema()
    {
        return [
            FileUpload::make('contract_file')
                ->label('Contract File')
                ->required()
        ];
    }

    /**
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    public function submit()
    {
        $contract = Contract::query()->where(['id' => session()->get('contract_id')])
            ->firstOrFail();
        ContractService::updateContract($contract,'accepted');

        Notification::make()
            ->title('Contract Accepted')
            ->body('Contract has been accepted successfully.')
            ->success()
            ->send();
        $this->emit('openModal', 'contracts.rating');
    }

    public function render()
    {
        return view('livewire.contracts.accept');
    }
}
