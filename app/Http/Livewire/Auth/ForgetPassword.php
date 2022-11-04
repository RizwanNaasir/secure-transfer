<?php

namespace App\Http\Livewire\Auth;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Notifications\Notification;
use Illuminate\Support\Facades\Password;
use Illuminate\Validation\ValidationException;
use LivewireUI\Modal\ModalComponent;

class ForgetPassword extends ModalComponent implements HasForms
{
    use InteractsWithForms;

    public string $email = '';

    /**
     * @throws ValidationException
     */
    public function submit()
    {
        try {
            $status = Password::sendResetLink(
                ['email' => $this->email]
            );
            if ($status == Password::RESET_LINK_SENT) {
                $this->closeModal();
                Notification::make()->title('Reset password link sent to your email')->success()->send();
            } else {
                Notification::make()->title('Something went wrong')->danger()->send();
            }
        } catch (\Exception $exception) {
            Notification::make()->title($exception->getMessage())->danger()->send();
        }
    }

    public function render()
    {
        return view('livewire.auth.forget-password');
    }

    protected function getFormSchema(): array
    {
        return [
            TextInput::make('email')
                ->required()
                ->placeholder('email@example.com')
                ->exists('users', 'email'),
        ];
    }
}
