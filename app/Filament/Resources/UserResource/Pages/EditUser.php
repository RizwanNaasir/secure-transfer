<?php

namespace App\Filament\Resources\UserResource\Pages;

use App\Filament\Resources\UserResource;
use Closure;
use Filament\Notifications\Notification;
use Filament\Pages\Actions\Action;
use Filament\Pages\Actions\ActionGroup;
use Filament\Pages\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;
use Filament\Tables\Actions\Concerns\InteractsWithRecords;

class EditUser extends EditRecord
{
    use InteractsWithRecords;

    protected static string $resource = UserResource::class;

    /**
     * @throws \Exception
     */
    protected function getActions(): array
    {
        return [
            DeleteAction::make(),
            ActionGroup::make([
                Action::make('Approve')
                    ->action($this->changeStatus('active'))
                    ->color('success')
                    ->icon('heroicon-o-check-circle'),
                Action::make('Block')
                    ->action($this->changeStatus('blocked'))
                    ->color('danger')
                    ->icon('heroicon-o-x-circle'),
            ])->label('Change status')->icon('heroicon-o-cog'),
        ];
    }

    public function changeStatus(string $status): Closure
    {
        return function () use ($status) {
            $this->record->update(['status' => $status]);
            $notification = Notification::make()->title('User ' . $status);
            $notification = $status === 'active'
                ? $notification->success()
                : $notification->danger();
            $notification->send();
        };
    }
}
