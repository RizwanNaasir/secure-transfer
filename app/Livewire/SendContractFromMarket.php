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
                        'wallet' => 'Payment by Wallet',
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
        if (\Auth::check())
        {
            /*if ($this->preferred_payment_method === 'stripe') {
                $product = $this->product;
                $balance = auth()->user()->balance_int;
                if ($balance < $product->price) {
                    $this->addError('preferred_payment_method', 'You don\'t have enough balance to send this contract');
                    return;
                }
                else {
                    try {
                        ContractService::create($this->getFormattedData(), auth()->user(), $this->product);
                        $this->addMessagesFromOutside('Contract sent successfully');
                    } catch (Exception $e) {
                        $this->addError('preferred_payment_method', 'Something went wrong, please try again later');
                    }


                }
                $this->redirect(url('/market_details', $product->id));
            }*/
            switch ($this->preferred_payment_method) {
                case 'wallet':
                    $product = $this->product;
                    $balance = auth()->user()->balance_int;
                    if ($balance < $product->price) {
                        $this->addError('preferred_payment_method', 'You don\'t have enough balance to send this contract');
                    } else {
                        try
                        {
                            $data = [
                                'email' => $this->product->user->email,
                                'amount' => $this->product->price,
                                'description' => $this->product->description,
                                'preferred_payment_method' => $this->preferred_payment_method,
                            ];
                            ContractService::create($data, auth()->user(), $product);
                            auth()->user()->withdraw($data['amount']);
                            \Session::put('message', 'Contract sent successfully by ' . $this->preferred_payment_method);

                            $this->redirect(url('/market_details', $product->id));
                        } catch (Exception $e) {
                            $this->addError('preferred_payment_method', 'Something went wrong, please try again later');
                        }
                    }
                    break;

                case 'bank':
                case 'crypto':
                    $data = [
                        'email' => $this->product->user->email,
                        'amount' => $this->product->price,
                        'description' => $this->product->description,
                        'preferred_payment_method' => $this->preferred_payment_method,
                    ];
                    try {
                        ContractService::create($data, auth()->user(), $this->product);
                        $this->addMessagesFromOutside('Contract sent successfully');
                        \Session::put('message', 'Contract sent successfully by ' . $this->preferred_payment_method);
                        $this->redirect(url('/market_details', $this->product->id));
                    } catch (Exception $e) {
                        $this->addError('preferred_payment_method', 'Something went wrong, please try again later');
                    }
                    break;
            }
        }
        else {
            $this->addError('preferred_payment_method', 'You need to login to send contract');
            return;
        }
    }
}
