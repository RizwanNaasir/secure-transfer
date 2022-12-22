<?php

namespace App\Http\Livewire\Auth;

use App\Models\User;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Notifications\Notification;
use Illuminate\Validation\ValidationException;
use LivewireUI\Modal\ModalComponent;

class Register extends ModalComponent implements HasForms
{
    use InteractsWithForms;

    public string $name = '';
    public string $surname = '';
    public string $email = '';
    public string $phone = '';
    public string $password = '';
    public string $password_confirmation = '';

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

        $this->closeModal();
        Notification::make()->title('Registration successful')->success()->send();
        return redirect()->to('/');
    }

    public function render()
    {
        return view('livewire.auth.register');
    }

    protected function getFormSchema(): array
    {
        return [
            Grid::make(4)->schema([
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
            ]),
            TextInput::make('email')
                ->label(__('lang.email'))
                ->required()
                ->placeholder('email@example.com')
                ->email()
                ->unique('users', 'email'),
            TextInput::make('phone')
                ->label(__('lang.phone'))
                ->required()
                ->placeholder('+92 (123) 456 7890')
                ->unique('users', 'phone')
                ->maxLength(255),
            Grid::make(4)->schema([
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
            ]),
        ];
    }

    private function getAvatar(): mixed
    {
        if (isset($this->avatar)) {
            $avatar = collect($this->avatar)->map(function ($file) {
                return $file->store('avatars');
            })->first();
        } else {
            $avatar = 'avatars/default.png';
        }
        return $avatar;
    }
}
