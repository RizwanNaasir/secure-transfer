<?php

namespace App\Livewire;

use Bavix\Wallet\Models\Transaction;
use Filament\Actions\Action;
use Filament\Actions\Concerns\InteractsWithActions;
use Filament\Actions\Contracts\HasActions;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Pages\Concerns\InteractsWithHeaderActions;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Table;
use Livewire\Component;

class ListTransactions extends Component implements HasForms, HasTable, HasActions
{
    use
        InteractsWithTable,
        InteractsWithActions,
        InteractsWithForms;



    public function table(Table $table): Table
    {
        return $table
            ->query(Transaction::query()->latest())
            ->columns([
                TextColumn::make('type')->sortable()->searchable(),
                TextColumn::make('amount')->badge()->color(function (Transaction $transaction) {
                    return $transaction->type === Transaction::TYPE_DEPOSIT ? 'success' : 'danger';
                })->sortable()->searchable(),
                TextColumn::make('confirmed')->sortable()->searchable(),
                TextColumn::make('created_at')->dateTime('Y-m-d H:i:s'),
            ])
            ->headerActions([
               /* CreateAction::make()->label('Top up Wallet')
                    ->modalHeading('Top up Wallet')
                    ->modalSubmitActionLabel('Pay Now')
                    ->modalContent(view('livewire.top-up'))
                    ->modalCancelAction(false)
                    ->modalSubmitAction(false)*/
                     /*->requiresConfirmation()*/

//                ->modalFooterActions([
//                /*    Action::make('payWithStripe')
//                        ->action(function(Get $get){
//                          dd($get('amount'));
//                        })*/
//            ])
            ])
            ->filters([
                // ...
            ])
            ->actions([
                // ...
            ])
            ->bulkActions([
                // ...
            ]);
    }


    /*public function render()
    {
        return view('filament.app.pages.wallet');
    }*/
    public function payWithStripe()
    {
        $this->redirect(route('stripe.top-up-wallet'));
    }
    protected function getHeaderActions(): array
    {
        return [
            Action::make('edit')
            ->url(route('stripe.top-up-wallet'))

        ];
    }
}
