<?php

namespace App\Filament\App\Resources;

use App\Filament\App\Resources\PayoutRequestResource\Pages;
use App\Filament\App\Resources\PayoutRequestResource\RelationManagers;
use App\Models\PayoutRequest;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PayoutRequestResource extends Resource
{
    protected static ?string $model = PayoutRequest::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('bank_detail_id')->label('Bank')
                    ->options(function (){
                        return \App\Models\BankDetail::query()->
                        where('user_id', auth()
                            ->user()->id)
                            ->get()
                            ->pluck('bank_name', 'id');
                    })->required()
                    ->placeholder('Select Bank or Add new From Profile')
                ->searchable()
                ->preload(),
                Forms\Components\TextInput::make('amount')
                    ->numeric()
                    ->maxValue(function (){
                        return auth()->user()->balanceInt;
                    })
                    ->required()
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->modifyQueryUsing(function (Builder $query) {
                $query->where('user_id', auth()->user()->id);
            })
            ->columns([
                Tables\Columns\TextColumn::make('bank.bank_name')
                    ->sortable(),
                Tables\Columns\TextColumn::make('amount')
                    ->searchable(),
                Tables\Columns\TextColumn::make('status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'declined' => 'danger',
                        'approved' => 'success',
                        default => 'gray',
                    }),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make()->hidden(function (PayoutRequest $payoutRequest) {
                    return $payoutRequest->status !== 'pending';
                }),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPayoutRequests::route('/'),
            'create' => Pages\CreatePayoutRequest::route('/create'),
            'edit' => Pages\EditPayoutRequest::route('/{record}/edit'),
        ];
    }
}
