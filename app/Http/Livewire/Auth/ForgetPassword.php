<?php

namespace App\Http\Livewire\Auth;

use App\Models\User;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Notifications\Notification;
use Illuminate\Validation\ValidationException;
use LivewireUI\Modal\ModalComponent;

class ForgetPassword extends ModalComponent implements  HasForms
{
    use InteractsWithForms;
    public string $email = '';

    protected function getFormSchema(): array
    {
        return [
            TextInput::make('email')
                ->required()
                ->placeholder('email@example.com')
                ->exists('users', 'email'),
        ];
    }

    /**
     * @throws ValidationException
     */
    public function submit()
    {
        $this->validate();
        $user = User::query()
            ->whereEmail($this->email)
            ->first();
        try {
            $user->sendPasswordResetNotification(
                $user->createToken('password-reset')->plainTextToken
            );
            $this->closeModal();
            Notification::make()->title('Reset password link sent to your email')->success()->send();
        }catch (\Exception $exception){
            Notification::make()->title('Something went wrong')->danger()->send();
        }
    }

    public function render()
    {
        return view('livewire.auth.forget-password');
    }
}
