<?php

namespace App\Http\Livewire\Contracts;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use LivewireUI\Modal\ModalComponent;

class Accept extends ModalComponent implements HasForms
{
    use InteractsWithForms;

    public array $contract_file;

    public function getFormSchema()
    {
        return [
            FileUpload::make('contract_file')
                ->label('Contract File')
                ->required()
        ];
    }

    public function accept()
    {
        dd($this->contract_file);
    }
    public function render()
    {
        return view('livewire.contracts.accept');
    }
}
