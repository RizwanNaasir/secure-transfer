<?php

namespace App\Http\Livewire\User;

use App\Models\User;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Notifications\Notification;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Validation\ValidationException;
use Livewire\Component;

class EditProfile extends Component implements HasForms
{
    use InteractsWithForms;

    public string $name = '';
    public string $surname = '';
    public string $email = '';
    public array|string $avatar = [];
    public string $phone = '';
    private User|Authenticatable|null $user = null;

    public function render()
    {
        return view('livewire.user.edit-profile');
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
                'avatar' => $this->getAvatar(),
            ]
        );
        Notification::make()->title('Profile updated')->success()->send();
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

    public function mount()
    {
        $this->form->fill(auth()->user()->toArray());
    }

    public function getFormModel(): User|Authenticatable|null
    {
        return $this->user;
    }

    protected function getFormSchema(): array
    {
        return [
            FileUpload::make('avatar')
                ->label('Avatar')
                ->placeholder('Upload your avatar')
                ->required()
                ->avatar()
                ->image()
                ->imageCropAspectRatio(1),
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
            Grid::make(4)->schema([
                TextInput::make('email')
                    ->required()
                    ->placeholder('email@example.com')
                    ->email()
                    ->unique('users', 'email', ignorable: auth()->user())
                    ->columnSpan(2),
                TextInput::make('phone')
                    ->required()
                    ->placeholder('+92 (123) 456 7890')
                    ->unique('users', 'phone', ignorable: auth()->user())
                    ->maxLength(255)
                    ->columnSpan(2),
            ]),
        ];
    }
}
