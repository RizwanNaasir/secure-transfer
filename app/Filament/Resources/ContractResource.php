<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ContractResource\Pages;
use App\Filament\Resources\ContractResource\RelationManagers\RecipientRelationManager;
use App\Filament\Resources\ContractResource\RelationManagers\UserRelationManager;
use App\Models\Contract;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Placeholder;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables\Columns\BadgeColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\Filter;
use Illuminate\Database\Eloquent\Builder;

class ContractResource extends Resource
{
    protected static ?string $model = Contract::class;

    protected static ?string $slug = 'contracts';

    protected static ?string $navigationGroup = 'Contracts';
    protected static ?string $recordTitleAttribute = 'id';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
               Grid::make(3)->schema([
                   Card::make([
                       TextInput::make('amount')
                           ->required()
                           ->numeric(),

                       TextInput::make('currency'),

                       TextInput::make('description'),

                       TextInput::make('preferred_payment_method'),

                       TextInput::make('amount_received_via'),

                       TextInput::make('file'),
                   ])->columnSpan(2),
                   Card::make([
                       Placeholder::make('created_at')
                           ->label('Created Date')
                           ->content(fn(?Contract $record): string => $record?->created_at?->diffForHumans() ?? '-'),

                       Placeholder::make('updated_at')
                           ->label('Last Modified Date')
                           ->content(fn(?Contract $record): string => $record?->updated_at?->diffForHumans() ?? '-'),
                   ])->columnSpan(1)
               ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id'),
                TextColumn::make('amount')->icon('heroicon-s-currency-dollar'),
                TextColumn::make('description'),
                BadgeColumn::make('status.status')
                    ->colors([
                        'warning' => 'pending',
                        'success' => 'accepted',
                        'danger' => 'declined',
                    ])
                    ->formatStateUsing(static fn(string $state): string => ucfirst($state)),
                TextColumn::make('user.email')->label('Sender')->limit(12),
                TextColumn::make('recipient.email')->label('Recipient')->limit(12),
                TextColumn::make('preferred_payment_method')
                    ->formatStateUsing(static fn(string $state): string => ucfirst($state)),
            ])->filters(self::getTableFilters());
    }
    protected static function getTableFilters(): array
    {
        return [
            Filter::make('status')
                ->form([
                    Select::make('status')->options([
                        'all' => 'All',
                        'pending' => 'Pending',
                        'accepted' => 'Accepted',
                        'declined' => 'Declined',
                    ])->default('all')
                ])
                ->query(static function (Builder $query, array $data): Builder {
                    return $query
                        ->when($data['status'] == 'all', static function (Builder $q) use ($data,$query ) {
                            return $q;
                        })
                        ->when($data['status'] != 'all', static function ($q) use ($data) {
                            return $q->whereHas('status', static function ($q) use ($data) {
                                return $q->where(['status' => $data]);
                            });
                        });
                })
        ];
    }
    public static function getRelations(): array
    {
        return [
            UserRelationManager::class,
            RecipientRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListContracts::route('/'),
            'view' => Pages\ViewContract::route('/{record}'),
//            'create' => Pages\CreateContract::route('/create'),
//            'edit' => Pages\EditContract::route('/{record}/edit'),
        ];
    }

    public static function getGloballySearchableAttributes(): array
    {
        return [];
    }
}