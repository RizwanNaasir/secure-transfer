<?php

namespace App\Http\Livewire;

use App\Models\Product;
use App\Services\ContractService;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\Placeholder;
use Filament\Forms\Components\Radio;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Notifications\Notification;
use LivewireUI\Modal\ModalComponent;

class SendContractFromMarket extends ModalComponent implements HasForms
{
    use InteractsWithForms;

    public string $preferred_payment_method = '';
    public $product;

    public function mount()
    {
        $this->product = Product::find(session()->get('product_id'));
    }

    public function getFormSchema(): array
    {
        return [
            Card::make([
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
        ];
    }

    public function submit()
    {
        ContractService::create($this->getFormattedData(),auth()->user(),$this->product);
        Notification::make()->title('Contract sent successfully!')->success()->send();
        $this->emit('openModal', 'qr-code-modal');
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
