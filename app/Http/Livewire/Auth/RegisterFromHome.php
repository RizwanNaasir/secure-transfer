<?php

namespace App\Http\Livewire\Auth;

use App\Models\User;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Notifications\Notification;
use Illuminate\Validation\ValidationException;
use Livewire\Component;

class RegisterFromHome extends Component implements  HasForms
{
    use InteractsWithForms;

    public string $name = '';
    public string $surname = '';
    public string $email = '';
    public string $phone = '';
    public string $password = '';
    public string $password_confirmation = '';

    protected function getFormSchema(): array
    {
        return [
            Grid::make(4)->schema([
                TextInput::make('name')
                    ->label('First Name')
                    ->required()
                    ->placeholder('John')
                    ->maxLength(255)
                    ->columnSpan(2),
                TextInput::make('surname')
                    ->label('Last Name')
                    ->required()
                    ->placeholder('Doe')
                    ->maxLength(255)
                    ->columnSpan(2),
            ]),
            TextInput::make('email')
                ->required()
                ->placeholder('email@example.com')
                ->email()
                ->unique('users', 'email'),
            TextInput::make('phone')
                ->required()
                ->placeholder('+92 (123) 456 7890')
                ->unique('users', 'phone')
                ->maxLength(255),
            Grid::make(4)->schema([
                TextInput::make('password')
                    ->required()
                    ->placeholder('Password')
                    ->type('password')
                    ->confirmed()
                    ->columnSpan(2),
                TextInput::make('password_confirmation')
                    ->required()
                    ->placeholder('Password Confirmation')
                    ->type('password')
                    ->columnSpan(2),
            ]),
        ];
    }

    /**
     * @throws ValidationException
     */
    public function submit()
    {
        $this->validate();

        User::query()->create([
            'name' => $this->name,
            'surname' => $this->surname,
            'email' => $this->email,
            'phone' => $this->phone,
            'password' => bcrypt($this->password),
        ]);

        auth()->attempt([
            'email' => $this->email,
            'password' => $this->password,
        ]);

        Notification::make()->title('Registration successful')->success()->send();

        if (!auth()->check()){
            Notification::make()->title('Registration failed')->danger()->send();
            return false;
        }
        return redirect()->to('/');
    }


    public function render()
    {
        return view('livewire.auth.register-from-home');
    }
}
