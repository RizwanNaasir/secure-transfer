<?php

namespace App\Http\Livewire;

use App\Models\User;
use Filament\Forms\Components\FileUpload;
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
    public string $email = '';
    public string $password = '';
    public string $password_confirmation = '';
    public array $avatar = [];

    protected function getFormSchema(): array
    {
        return [
            FileUpload::make('avatar')
                ->label('Avatar')
                ->maxSize(1024 * 1024 * 2),
            TextInput::make('name')
                ->required()
                ->reactive()
                ->placeholder('John Doe')
                ->maxLength(255),
            TextInput::make('email')
                ->required()
                ->reactive()
                ->placeholder('email@example.com')
                ->email()
                ->unique('users', 'email'),
            TextInput::make('password')
                ->required()
                ->reactive()
                ->password()
                ->placeholder('password'),
            TextInput::make('password_confirmation')
                ->required()
                ->reactive()
                ->password()
                ->placeholder('password')
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
            'email' => $this->email,
            'password' => bcrypt($this->password),
            'avatar' => $this->getAvatar(),
        ]);

        auth()->attempt([
            'email' => $this->email,
            'password' => $this->password,
        ]);

        $this->closeModal();
        Notification::make()->title('Registration successful')->success()->send();
        return redirect()->to('/');
    }
    /**
     * @return \Closure|mixed|string|null
     */
    private function getAvatar(): mixed
    {
        if (isset($this->avatar)) {
            $avatar = collect($this->avatar)->map(function ($file) {
                return $file->store('public/avatars');
            })->first();
        } else {
            $avatar = 'avatars/default.png';
        }
        return $avatar;
    }

    public function render()
    {
        return view('livewire.register');
    }
}
