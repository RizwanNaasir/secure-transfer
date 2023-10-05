<?php

namespace App\Filament\App\Resources;

use App\Filament\App\Resources\ContractResource\Pages;
use App\Filament\Resources\ContractResource\RelationManagers\RecipientRelationManager;
use App\Filament\Resources\ContractResource\RelationManagers\UserRelationManager;
use App\Models\Contract;
use App\Models\Product;
use App\Services\ContractService;
use Exception;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Radio;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Forms\Components\Tabs;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Components\Tab;
use Filament\Resources\Resource;
use Filament\Tables\Actions\BulkActionGroup;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\DeleteBulkAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;

class ContractResource extends Resource
{
    protected static ?string $model = Contract::class;
    protected static ?string $navigationIcon = 'heroicon-o-bars-3-bottom-right';

    public static function getRelations(): array
    {
        return [
            UserRelationManager::class,
            RecipientRelationManager::class,
        ];
    }

    /**
     * @throws Exception
     */
    public static function table(Table $table): Table
    {
        return $table
            ->columns(self::getContractColumns())
            ->filters(self::getTableFilters())
            ->actions([
                EditAction::make(),
                DeleteAction::make()
                    ->action(fn(Contract $record) => ContractService::deleteContract($record)),
            ])
            ->bulkActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make()
                        ->action(function (Collection $records) {
                            return $records->each(function (Contract $record) {
                                ContractService::deleteContract($record);
                            });
                        }),
                ]),
            ]);
    }

    /**
     * @throws Exception
     */
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
                        ->when($data['status'] == 'all', static function (Builder $q) use ($data, $query) {
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

    public static function form(Form $form): Form
    {
        return $form
            ->disabled(function (?Contract $contract) {
                $contractIsReceived = \DB::table('contract_user')
                    ->where('contract_id', $contract->id)
                    ->where('recipient_id', auth()->id())
                    ->exists();
                return $contractIsReceived && $contract->is_pending;
            })
            ->schema([
                Grid::make(3)->schema([
                    Section::make()->schema([

                        TextInput::make('email')
                            ->rules(['email', 'exists:users,email'])
                            ->required()
                            ->disabled(function (Pages\EditContract|Pages\CreateContract $livewire) {
                                return $livewire->getRecord() !== null;
                            })
                            ->autofocus(),

                        TextInput::make('amount')
                            ->required()
                            ->prefix('$')
                            ->minValue(1)
                            ->disabled(function (Pages\EditContract|Pages\CreateContract $livewire) {
                                return $livewire->getRecord() !== null;
                            })
                            ->numeric(),

                        TextInput::make('description'),


                        Radio::make('preferred_payment_method')
                            ->label('Preferred Payment Method:')
                            ->inline()
                            ->options([
                                'bank_transfer' => 'Bank Transfer',
                                'crypto' => 'Crypto',
                                'wallet' => 'Payment by Wallet',
                            ]),
                        Tabs::make('Product/File')
                            ->tabs([
                                Tabs\Tab::make('Product')
                                    ->schema([
                                        Select::make('product')
                                            ->searchable()
                                            ->options(function () {
                                                return Product::query()
                                                    ->where('user_id', auth()->id())
                                                    ->get()
                                                    ->mapWithKeys(function (Product $product) {
                                                        return [$product->id => $product->name];
                                                    });
                                            })
                                    ]),
                                Tabs\Tab::make('File')
                                    ->badge(function (?Contract $record) {
                                        return $record?->hasMedia(Contract::MEDIA_COLLECTION) ? 1 : null;
                                    })
                                    ->schema([
                                        SpatieMediaLibraryFileUpload::make('file')->collection(Contract::MEDIA_COLLECTION),
                                    ]),
                            ]),
                    ])->columnSpan(2),
                ])
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListContracts::route('/'),
            'create' => Pages\CreateContract::route('/create'),
            'edit' => Pages\EditContract::route('/{record}/edit'),
        ];
    }

    /**
     * @return array
     */
    public static function getContractColumns(): array
    {
        return [
            TextColumn::make('id')->sortable(),
            TextColumn::make('amount')->icon('heroicon-s-currency-dollar'),
            TextColumn::make('description')->limit(30),
            TextColumn::make('status.status')
                ->badge()
                ->colors([
                    'warning' => 'pending',
                    'success' => 'accepted',
                    'danger' => 'declined',
                ])
                ->formatStateUsing(static fn(?string $state): ?string => ucfirst($state)),
            TextColumn::make('user.full_name')
                ->label('Sender')
                ->limit(19)
                ->formatStateUsing(function (Contract $record) {
                    return $record->user->first()->id === auth()->id()
                        ? 'You' : $record->user->first()->full_name;
                }),
            TextColumn::make('recipient.full_name')
                ->label('Recipient')
                ->limit(19)
                ->formatStateUsing(function (Contract $record) {
                    return $record->recipient->first()->id === auth()->id()
                        ? 'You' : $record->recipient->first()->full_name;
                }),
            TextColumn::make('preferred_payment_method')
                ->formatStateUsing(static fn(?string $state): ?string => ucfirst($state)),
        ];
    }
}
