<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProductResource\Pages;
use App\Models\Product;
use App\Models\User;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables\Actions\Action;
use Filament\Tables\Actions\BulkAction;
use Filament\Tables\Columns\SpatieMediaLibraryImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;

class ProductResource extends Resource
{
    protected static ?string $model = Product::class;

    protected static ?string $slug = 'products';

    protected static ?string $navigationIcon = 'heroicon-o-shopping-cart';
    protected static ?string $activeNavigationIcon = 'heroicon-s-shopping-cart';

    protected static ?string $recordTitleAttribute = 'id';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('user_id')->options(User::all()->pluck('name','id')),
                TextInput::make('name'),
                Textarea::make('description'),
                Textarea::make('price'),
                SpatieMediaLibraryFileUpload::make('image')->collection(Product::IMAGE_COLLECTION)
            ]);
    }

    /**
     * @throws \Exception
     */
    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                SpatieMediaLibraryImageColumn::make('image')
                    ->collection(Product::IMAGE_COLLECTION),
                TextColumn::make('name'),
                TextColumn::make('description')->limit(30),
                TextColumn::make('price')
            ])->actions([
                Action::make('Approve')
                    ->action(fn(Product $record) => $record->approve())
                    ->color('success')
                    ->icon('heroicon-o-check-circle')
                    ->visible(fn(Product $record) => !$record->approved),
                Action::make('Block')
                    ->action(fn(Product $record) => $record->approve())
                    ->color('danger')
                    ->icon('heroicon-o-x-circle')
                    ->visible(fn(Product $record) => $record->approved)
            ])->bulkActions([
                BulkAction::make('Approve')
                    ->action(fn(Collection $records) => $records->each(fn(Product $product) => $product->approve()))
                    ->color('success')
                    ->icon('heroicon-o-check-circle'),
                BulkAction::make('Block')
                    ->action(fn(Collection $records) => $records->each(fn(Product $product) => $product->approve()))
                    ->color('danger')
                    ->icon('heroicon-o-x-circle')
            ])
            ->filters([
                SelectFilter::make('user')->relationship('user', 'name')
                ->searchable()
            ])
            ;
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListProducts::route('/'),
            'create' => Pages\CreateProduct::route('/create'),
            'edit' => Pages\EditProduct::route('/{record}/edit'),
        ];
    }

    public static function getGloballySearchableAttributes(): array
    {
        return [];
    }
}
