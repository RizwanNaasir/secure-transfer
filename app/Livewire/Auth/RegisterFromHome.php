<?php

namespace App\Livewire\Auth;

use App\Models\User;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Illuminate\Validation\ValidationException;
use Livewire\Component;

class RegisterFromHome extends Component implements HasForms
{
    use InteractsWithForms;

    public string $name = '';
    public string $surname = '';
    public string $email = '';
    public string $phone = '';
    public string $password = '';
    public string $password_confirmation = '';
    public ?object $tempUser = null;

    public function mount()
    {
        if (isset($this->tempUser)) {
            $this->form->fill([
                'name' => $this->tempUser->name,
                'surname' => $this->tempUser->surname,
                'email' => $this->tempUser->email,
                'phone' => $this->tempUser->phone ?? '',
            ]);
        }
    }

    /**
     * @throws ValidationException
     */
    public function submit()
    {
        $this->validate();

        User::query()->updateOrCreate(
            [
                'email' => $this->email]
            , [
                'name' => $this->name,
                'surname' => $this->surname,
                'email' => $this->email,
                'phone' => $this->phone,
                'password' => bcrypt($this->password),
            ]
        );

        auth()->attempt([
            'email' => $this->email,
            'password' => $this->password,
        ]);

        Notification::make()->title('Registration successful')->success()->send();

        if (!auth()->check()) {
            Notification::make()->title('Registration failed')->danger()->send();
            return false;
        }
        return redirect()->to('/');
    }

    public function render()
    {
        return view('livewire.auth.register-from-home');
    }

    public function form(Form $form): Form
    {
        return $form->schema([
            TextInput::make('name')
                ->label(__('lang.first_name'))
                ->required()
                ->placeholder('John')
                ->maxLength(255)
                ->columnSpan(2),
            TextInput::make('surname')
                ->label(__('lang.last_name'))
                ->required()
                ->placeholder('Doe')
                ->maxLength(255)
                ->columnSpan(2),
            TextInput::make('email')
                ->label(__('lang.email'))
                ->required()
                ->placeholder('email@example.com')
                ->email()
                ->unique('users', 'email', ignorable: $this->tempUser),
            TextInput::make('phone')
                ->label(__('lang.phone'))
                ->required()
                ->placeholder('+92 (123) 456 7890')
                ->unique('users', 'phone')
                ->maxLength(255),
            TextInput::make('password')
                ->label(__('lang.password'))
                ->required()
                ->placeholder(__('lang.password'))
                ->type('password')
                ->confirmed()
                ->columnSpan(2),
            TextInput::make('password_confirmation')
                ->label(__('lang.password_confirmation'))
                ->required()
                ->placeholder(__('lang.password_confirmation'))
                ->type('password')
                ->columnSpan(2),
        ]);
    }
}
