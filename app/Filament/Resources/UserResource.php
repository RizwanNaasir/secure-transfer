<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserResource\Pages;
use App\Models\User;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Actions\Action;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Columns\BadgeColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Collection;

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-o-user-group';
    protected static ?string $activeNavigationIcon = 'heroicon-s-user-group';

    public static function form(Form $form): Form
    {
        return $form
            ->schema(self::retrieveFormFields());
    }

    /**
     * @throws \Exception
     */
    public static function table(Table $table): Table
    {
        return $table
            ->columns(self::generateUserColumns())
            ->filters([
                //
            ])
            ->actions(self::getActions())
            ->bulkActions(self::getBulkActions());
    }

    /**
     * @return array
     * @throws \Exception
     */
    public static function getActions(): array
    {
        return [
            Action::make('Approve')
                ->action(fn(User $record) => $record->changeStatus('active'))
                ->color('success')
                ->icon('heroicon-o-check-circle')
                ->visible(fn(User $record) => !$record->is_approved_by_admin),
            Action::make('Block')
                ->action(fn(User $record) => $record->changeStatus('blocked'))
                ->color('danger')
                ->icon('heroicon-o-x-circle')
                ->visible(fn(User $record) => $record->is_approved_by_admin),
            EditAction::make(),
            DeleteAction::make(),
//            Tables\Actions\Action::make('view')
//                ->url(fn(User $record): string => route('filament.pages.view', ['user' => $record]))
        ];
    }

    /**
     * @return array
     * @throws \Exception
     */
    public static function getBulkActions(): array
    {
        return [
            Tables\Actions\DeleteBulkAction::make(),
            Tables\Actions\BulkAction::make('Approve')
                ->action(fn(Collection $records) => $records->each(fn(User $user) => $user->changeStatus('active')))
                ->color('success')
                ->icon('heroicon-o-check-circle'),
            Tables\Actions\BulkAction::make('Block')
                ->action(fn(Collection $records) => $records->each(fn(User $user) => $user->changeStatus('blocked')))
                ->color('danger')
                ->icon('heroicon-o-x-circle')
        ];
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
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
            'view' => Pages\EditUser::route('/{record}/view'),
        ];
    }

    /**
     * @return array
     */
    public static function retrieveFormFields(): array
    {
        return [
            SpatieMediaLibraryFileUpload::make('avatar')
                ->columnSpan(2)
                ->avatar()
                ->collection(User::AVATAR_COLLECTION),
            TextInput::make('name')
                ->required()
                ->maxLength(255),
            TextInput::make('surname')
                ->maxLength(255),
            TextInput::make('email')
                ->email()
                ->required()
                ->maxLength(255),
            TextInput::make('phone')
                ->tel()
                ->maxLength(255),
            SpatieMediaLibraryFileUpload::make('document1')
                ->label('First Document')
                ->downloadable()
                ->collection(User::DOCUMENTS_COLLECTION1),
            SpatieMediaLibraryFileUpload::make('document2')
                ->label('Second Document')
                ->collection(User::DOCUMENTS_COLLECTION2)
                ->downloadable(),
        ];
    }

    /**
     * @return array
     */
    public static function generateUserColumns(): array
    {
        return [
            TextColumn::make('id')->sortable(),
            ImageColumn::make('avatar')->circular()->disk(''),
            TextColumn::make('full_name'),
            TextColumn::make('email'),
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
        ];
    }
}
