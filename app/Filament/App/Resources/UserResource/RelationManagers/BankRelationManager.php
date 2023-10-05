<?php

namespace App\Filament\App\Resources\UserResource\RelationManagers;

use App\Models\BankDetail;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Model;
use PhpParser\Node\Expr\AssignOp\Mod;

class BankRelationManager extends RelationManager
{
    protected static string $relationship = 'bank';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('account_holder_name')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('bank_name')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('account_number')
                    ->numeric()
                    ->maxValue(16)
                    ->required()
                    ->maxLength(255),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('bank_account_title')
            ->columns([
                Tables\Columns\TextColumn::make('id'),
                Tables\Columns\TextColumn::make('account_holder_name'),
                Tables\Columns\TextColumn::make('bank_name'),
                Tables\Columns\TextColumn::make('account_number'),
                Tables\Columns\IconColumn::make('active')->boolean(),

            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make()
                ->hidden(function (){
                    return BankDetail::where('user_id', auth()->user()->id)->exists();
                })
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
}
