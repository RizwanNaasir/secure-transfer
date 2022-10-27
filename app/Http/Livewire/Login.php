<?php

namespace App\Http\Livewire;

use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Notifications\Notification;
use LivewireUI\Modal\ModalComponent;

class Login extends ModalComponent implements HasForms
{
    use InteractsWithForms;

    public string $email = '';
    public string $password = '';
    public bool $remember_me = false;

    public function submit()
    {
        auth()->attempt([
            'email' => $this->email,
            'password' => $this->password,
        ], $this->remember_me);

        if (auth()->check()) {
            $this->closeModal();
            Notification::make()->title('Login successful')->success()->send();
            return redirect()->to('/');
        }
        Notification::make()->title('Invalid Credentials')->danger()->send();
    }

    protected function getFormSchema(): array
    {
        return [
            TextInput::make('email')
                ->required()
                ->reactive()
                ->placeholder('email@example.com')
                ->exists('users', 'email'),
            TextInput::make('password')
                ->required()
                ->reactive()
                ->password()
                ->placeholder('password'),
            Checkbox::make('remember_me')
                ->label('Remember me')
                ->default(true),
        ];
    }
    public function render()
    {
        return view('livewire.login');
    }
}
