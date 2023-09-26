<?php

namespace App\Filament\Resources\ContractResource\RelationManagers;

use App\Models\User;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Placeholder;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables\Table;
use Filament\Tables\Columns\BadgeColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;

class RecipientRelationManager extends RelationManager
{
    protected static string $relationship = 'recipient';

    protected static ?string $recordTitleAttribute = 'name';

    public function form(Form $form): Form
    {
        return $form
            ->schema([]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->columns([

                ImageColumn::make('avatar')->circular()->disk(''),


                TextColumn::make('full_name')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('email')
                    ->searchable()
                    ->sortable(),

                BadgeColumn::make('status')
                    ->colors([
                        'success' => 'active',
                        'secondary' => 'pending',
                        'danger' => 'blocked',
                    ])->formatStateUsing(static fn(string $state): string => ucfirst($state)),
                BadgeColumn::make('email_verified_at')->label('Verified Email')
                    ->colors([
                        'success',
                        'danger' => null,
                    ])->formatStateUsing(function ($state) {
                        return isset($state) ? 'Yes' : 'No';
                    }),
            ]);
    }
}