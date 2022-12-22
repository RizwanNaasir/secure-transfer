<?php

namespace App\Http\Livewire\Contracts;

use App\Models\User;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Notifications\Notification;
use LivewireUI\Modal\ModalComponent;
use Yepsua\Filament\Forms\Components;

class Rating extends ModalComponent implements HasForms
{
    use InteractsWithForms;

    public int $stars = 0;
    public $recipient;

    public function mount(int $recipient_id)
    {
        $this->recipient = User::find($recipient_id);
    }

    public function star()
    {
        $rated = auth()->user()->review(
            modelTobeReviewed: $this->recipient,
            reviewer: auth()->user(),
            stars: $this->stars
        );


        if ($rated or gettype($rated) === 'integer') {
            Notification::make()->success()
                ->title('Rated !')
                ->body('You have successfully rated ' . $this->recipient->fullname)
                ->send();
            $this->closeModal();
        }
    }

    protected function getFormSchema(): array
    {
        return [
            Components\Rating::make('stars')
                ->label('Rate')
                ->size(10)
                ->required()
                ->columnSpan(2)
        ];
    }
}
