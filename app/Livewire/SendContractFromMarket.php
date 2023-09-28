<?php

namespace App\Livewire;

use App\Models\Product;
use App\Services\ContractService;
use Filament\Actions\Concerns\InteractsWithActions;
use Filament\Actions\Contracts\HasActions;
use Filament\Forms\Components\Placeholder;
use Filament\Forms\Components\Radio;
use Filament\Forms\Components\Section;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use LivewireUI\Modal\ModalComponent;

class SendContractFromMarket extends ModalComponent implements HasForms, HasActions
{
    use InteractsWithForms, InteractsWithActions;

    public string $preferred_payment_method = '';
    public ?Product $product = null;

    public function mount()
    {
        $this->product = Product::find(session()->get('product_id'));
    }

    public function form(Form $form): Form
    {
        return $form->schema([
            Section::make([
                Placeholder::make('Price')
                    ->content('Price of This Product is $' . $this->product->price),
                Radio::make('preferred_payment_method')
                    ->label('Select you preferred payment method')
                    ->options([
                        'crypto' => 'Crypto',
                        'bank' => 'Bank',
                    ])->inline()->required()
                    ->extraAttributes(['class' => 'gap-10'])
            ])
        ]);
    }

    public function submit()
    {
        ContractService::create($this->getFormattedData(),auth()->user(),$this->product);
        Notification::make()->title('Contract sent successfully!')->success()->send();
    }

    public function getFormattedData(): array
    {
        return [
            'email' => $this->product->user->email,
            'amount' => $this->product->price,
            'description' => $this->product->description,
            'file' => $this->product->image,
            'preferred_payment_method' => $this->preferred_payment_method,
        ];
    }
}
