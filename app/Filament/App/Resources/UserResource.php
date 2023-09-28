<?php

namespace App\Filament\App\Resources;

use App\Filament\App\Resources\UserResource\Pages;
use App\Filament\App\Resources\UserResource\RelationManagers;
use App\Models\User;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $label = 'Profile';

    protected static ?string $pluralLabel = 'My Profile';

    protected static bool $shouldRegisterNavigation = false;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema(\App\Filament\Resources\UserResource::retrieveFormFields());
    }

    public static function table(Table $table): Table
    {
        return $table
            ->modifyQueryUsing(fn(Builder $query) => $query->where('id', auth()->id()))
            ->columns(\App\Filament\Resources\UserResource::generateUserColumns())
            ->actions([
                Tables\Actions\EditAction::make(),
            ])->paginated(false);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListUsers::route('/'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
        ];
    }
}
