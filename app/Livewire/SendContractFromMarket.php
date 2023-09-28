<?php

namespace App\Livewire;

use App\Models\Product;
use App\Services\ContractService;
use Exception;
use Filament\Actions\Concerns\InteractsWithActions;
use Filament\Actions\Contracts\HasActions;
use Filament\Forms\Components\Radio;
use Filament\Forms\Components\Section;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
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
                Radio::make('preferred_payment_method')
                    ->label('Select you preferred payment method')
                    ->options([
                        'crypto' => 'Crypto',
                        'bank' => 'Bank',
                    ])->inline()
                    ->required()
            ])
        ]);
    }

    public function submit(): void
    {
        $contractThatAlreadyExists = $this->product->contracts()->with('user', function ($query) {
            $query->where('id', auth()->id());
        })->where('preferred_payment_method', $this->preferred_payment_method)->exists();

        if ($contractThatAlreadyExists) {
            $this->addError('preferred_payment_method', 'You already sent a contract for this product with this payment method');
            return;
        }
        try {
            ContractService::create($this->getFormattedData(), auth()->user(), $this->product);
            $this->addMessagesFromOutside('Contract sent successfully');
        } catch (Exception $e) {
            $this->addError('preferred_payment_method', 'Something went wrong, please try again later');
        }
    }

    public function getFormattedData(): array
    {
        $file = file_get_contents($this->product->getFirstMedia(Product::IMAGE_COLLECTION)?->getFullUrl());
        if ($file) {
            request()->merge([
                'file' => $file
            ]);
        }
        return [
            'email' => $this->product->user->email,
            'amount' => $this->product->price,
            'description' => $this->product->description,
            'file' => $this->product->image,
            'preferred_payment_method' => $this->preferred_payment_method,
        ];
    }
}
