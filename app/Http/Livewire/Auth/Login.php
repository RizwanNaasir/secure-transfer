<?php

namespace App\Http\Livewire\Auth;

use App\Models\User;
use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Notifications\Notification;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use LivewireUI\Modal\ModalComponent;

class Login extends ModalComponent implements HasForms
{
    use InteractsWithForms;

    public string $email = '';
    public string $password = '';
    public bool $remember_me = false;

    /**
     * @throws ValidationException
     */
    public function submit()
    {
        $this->validate([
            'email' => ['required', 'email', 'exists:users,email'],
            'password' => ['required', 'min:6', function ($attribute, $value, $fail) {
                return $this->checkPassword($value, $fail, $attribute);
            }]
        ]);

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

    function checkPassword($value, $fail, $attribute): mixed
    {
        $user = User::query()->whereEmail($this->email)->first();
        if (is_null($user)) {
            return false;
        }
        if (Hash::check(value: $value, hashedValue: $user->password)) {
            return true;
        } else {
            return $fail(__('Incorrect ' . $attribute));
        }
    }

    public function render()
    {
        return view('livewire.auth.login');
    }

    protected function getFormSchema(): array
    {
        return [
            TextInput::make('email')
                ->required()
                ->placeholder('email@example.com'),
            TextInput::make('password')
                ->required()
                ->password()
                ->placeholder('password'),
            Checkbox::make('remember_me')
                ->label('Remember me')
                ->default(true),
        ];
    }
}
