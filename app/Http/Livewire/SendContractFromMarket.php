<?php

namespace App\Http\Livewire;

use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Notifications\Notification;
use LivewireUI\Modal\ModalComponent;

class SendContractFromMarket extends ModalComponent implements HasForms
{
    use InteractsWithForms;
    public int $price = 0;
    public string $description = '';
    public function render()
    {
        return view('livewire.send-contract-from-market');
    }
    public function getFormSchema(): array
    {
        return [
            TextInput::make('price')->numeric(),
            Textarea::make('description')

        ];
    }

    public function submit()
    {

//        dd($this->form->getState());
        $this->closeModal();
        Notification::make()->title('Contract sent successfully!')->success()->send();
    }
}
