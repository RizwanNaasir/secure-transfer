<?php

namespace App\Http\Livewire;

use App\Services\ContractService;
use Filament\Forms\Components\FileUpload;
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


    public function render()
    {
        return view('livewire.contract-form');
    }

    public function submit()
    {
        ContractService::create($this->formattedData(), auth()->user());
        Notification::make()->title('Contract sent successfully!')->success()->send();
        $this->emit('openModal', 'qr-code-modal');
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
                FileUpload::make('file')->columnSpan(4),
                ]),
            Radio::make('preferred_payment_method')
                ->options([
                    'crypto' => 'Crypto',
                    'bank' => 'Bank',
                ])->inline()->required()
                ->extraAttributes(['class' => 'gap-10'])
        ];
    }
    private function getFile(): mixed
    {
        if (isset($this->file)) {
            $file = collect($this->file)->map(function ($file) {
                return $file->store('files');
            })->first();
        } else {
            $file = null;
        }
        return $file;
    }

    public function formattedData(): array
    {
        return [
            'email' => $this->email,
            'amount' => $this->amount,
            'description' => $this->description,
            'file' => $this->getFile(),
            'preferred_payment_method' => $this->preferred_payment_method,
        ];
    }
}
