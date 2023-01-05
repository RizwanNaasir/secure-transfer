<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserResource\Pages;
use App\Filament\Resources\UserResource\RelationManagers;
use App\Models\User;
use Closure;
use Filament\Forms;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Notifications\Notification;
use Filament\Tables\Actions\Action;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Columns\BadgeColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                FileUpload::make('avatar')
                    ->columnSpan(2)
                    ->avatar()
                    ->directory('public'),
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
                FileUpload::make('document1')
                    ->label('First Document')
                    ->enableDownload()
                    ->directory('public'),
                FileUpload::make('document2')
                    ->label('Second Document')
                    ->directory('public')
                    ->enableDownload(),
            ]);
    }

    /**
     * @throws \Exception
     */
    public static function table(Table $table): Table
    {
        return $table
            ->columns([
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
            ])
            ->filters([
                //
            ])
            ->actions(self::getActions())
            ->bulkActions(self::getBulkActions());
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
            Tables\Actions\Action::make('view')
                ->url(fn(User $record): string => route('filament.pages.view', ['user' => $record]))
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
}
