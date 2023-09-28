<?php

namespace App\Livewire\Contracts;

use App\Models\User;
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

class NewContract extends Component implements HasForms
{
    use InteractsWithForms;

    public string $email = '';
    public string $amount = '';
    public string $description = '';
    public array $file = [];
    public string $preferred_payment_method = '';


    public function render()
    {
        return view('livewire.contracts.new-contract');
    }

    public function submit()
    {
        $this->validate([
            'email' => 'required|email|exists:users,email',
            'amount' => 'required',
            'description' => 'required',
            'file' => 'required',
            'preferred_payment_method' => 'required',
        ],[
            'email.exists' => 'User does not exists!'
        ]);


        ContractService::create($this->formattedData(), auth()->user());
        Notification::make()->title('Contract sent successfully!')->success()->send();
        $this->dispatch('openModal', 'qr-code-modal');
    }

    protected function getFormSchema(): array
    {
        return [
            TextInput::make('email')
                ->label(__('lang.email'))
                ->email()->required()
                ->datalist(
                    options: User::query()->pluck('email')->toArray()
                ),
            TextInput::make('amount')
                ->label(__('lang.amount'))
                ->numeric()->required(),
            Textarea::make('description')->label(__('lang.description')),
            Grid::make(4)
                ->schema([
                FileUpload::make('file')->label(__('lang.file'))->columnSpan(4),
                ]),
            Radio::make('preferred_payment_method')
                ->label(__('lang.preferred'))
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
                return $file->store('public');
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
