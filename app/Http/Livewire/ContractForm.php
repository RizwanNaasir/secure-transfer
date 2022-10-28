<?php

namespace App\Http\Livewire;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Radio;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Livewire\Component;

class ContractForm extends Component implements HasForms
{
    use InteractsWithForms;
    public string $email = '';
    public string $amount = '';
    public string $description = '';
    public array $file = [];
    public string $type_of_payment = '';

    public function render()
    {
        return view('livewire.contract-form');
    }

    protected function getFormSchema(): array
    {
        return [
            TextInput::make('email'),
            TextInput::make('amount')->numeric(),
            Textarea::make('description'),
            Grid::make(4)->schema([
                FileUpload::make('file')->columnSpan(4),
            ]),
            Radio::make('type_of_payment')->options([
                'crypto' => 'crypto',
                'back' => 'bank',
            ])->inline()->extraAttributes(['class'=>'gap-10'])
        ];
    }

    public function submit()
    {
        $this->emit('openModal', 'qr-code-modal');//QrCodeModal
//        dd($this->form->getState());
    }
}
