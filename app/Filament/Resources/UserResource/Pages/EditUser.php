<?php

namespace App\Filament\Resources\UserResource\Pages;

use App\Filament\Resources\UserResource;
use App\Models\User;
use Closure;
use Exception;
use Filament\Actions\Action;
use Filament\Actions\DeleteAction;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\EditRecord;
use Filament\Tables\Actions\Concerns\InteractsWithRecords;

/**
 * @property User $record
 */
class EditUser extends EditRecord
{
    use InteractsWithRecords;

    protected static string $resource = UserResource::class;

    /**
     * @throws Exception
     */
    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make()->hidden(fn() => $this->record->id === auth()->id()),
            Action::make('Approve')
                ->action($this->changeStatus('active'))
                ->color('success')
                ->icon('heroicon-o-check-circle')
                ->hidden(fn() => $this->record->id === auth()->id())
                ->visible(!$this->record->is_approved_by_admin),
            Action::make('Block')
                ->action($this->changeStatus('blocked'))
                ->color('danger')
                ->icon('heroicon-o-x-circle')
                ->hidden(fn() => $this->record->id === auth()->id())
                ->visible($this->record->is_approved_by_admin),
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
