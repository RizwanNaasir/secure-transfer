<?php

namespace App\Http\Livewire\Market;

use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Livewire\Component;
use LivewireUI\Modal\ModalComponent;

class SendContract extends ModalComponent implements HasForms
{
    use InteractsWithForms;
    public int $price = 0;
    public string $description = '';
    public function render()
    {
        return view('livewire.market.send-contract');
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
    }
}
