<?php

namespace App\Http\Livewire\Contracts;

use Filament\Forms\Components\Textarea;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use LivewireUI\Modal\ModalComponent;

class Decline extends ModalComponent implements HasForms
{
    use InteractsWithForms;
    public function render()
    {
        return view('livewire.contracts.decline');
    }
    protected function getFormSchema(): array
    {
        return [
            Textarea::make('reason')->disableLabel()
        ];
    }

    public function submit()
    {
        $this->closeModal();
    }
}
