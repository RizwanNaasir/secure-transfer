<?php

namespace App\Http\Livewire;

use App\Services\ContractService;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Radio;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Notifications\Notification;
use Livewire\Component;

class ContractForm extends Component implements HasForms
{
    use InteractsWithForms;

    public string $email = '';
    public string $amount = '';
    public string $description = '';
    public array $file = [];
    public string $preferred_payment_method = '';

    protected $listeners = [
        'qrCode' => 'qrCode',
    ];

    public function render()
    {
        return view('livewire.contract-form');
    }

    public function submit()
    {
        ContractService::create($this->form->getState(), auth()->user());
        Notification::make()->title('Contract sent successfully!')->success()->send();
        $this->emit('openModal', 'qr-code-modal');
    }

    public function qrCode($qrCode)
    {
        dd($qrCode);
    }

    protected function getFormSchema(): array
    {
        return [
            TextInput::make('email')
                ->email()->required(),
            TextInput::make('amount')
                ->numeric()->required(),
            Textarea::make('description'),
            Grid::make(4)
                ->schema([
//                FileUpload::make('file')->columnSpan(4),
                ]),
            Radio::make('preferred_payment_method')
                ->options([
                    'crypto' => 'Crypto',
                    'bank' => 'Bank',
                ])->inline()->required()
                ->extraAttributes(['class' => 'gap-10'])
        ];
    }
}
