<?php

namespace App\Livewire\User;

use App\Models\User;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Notifications\Notification;
use Illuminate\Contracts\View\View;
use Illuminate\Validation\ValidationException;
use Livewire\Component;

class EditProfile extends Component implements HasForms
{
    use InteractsWithForms;

    public mixed $avatar = '';
    public string $name = '';
    public null|string $surname = '';
    public string $email = '';
    public null|string $phone = '';
    public mixed $document1 = '';
    public mixed $document2 = '';

    public function render(): View
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
            attributes: ['email' => $this->email],
            values: [
                'name' => $this->name,
                'surname' => $this->surname,
                'email' => $this->email,
                'phone' => $this->phone,
            ]
        );
        Notification::make()->title('Profile updated')->success()->send();
    }

    private function getAvatar(): mixed
    {
        if (isset($this->avatar)) {
            $avatar = collect($this->avatar)->first();
        } else {
            $avatar = 'avatars/default.png';
        }
        return $avatar;
    }
    private function getDocuments(string $name): mixed
    {
        if (isset($this->$name)) {
            $name = collect($this->$name)
                ->map(static fn($file) => $file->store('public'))->first();
        } else {
            $name = null;
        }
        return $name;
    }

    public function mount(): void
    {
        $media = auth()->user()->getFirstMedia(User::AVATAR_COLLECTION);
        $document1 = auth()->user()->getFirstMedia(User::DOCUMENTS_COLLECTION1);
        $document2 = auth()->user()->getFirstMedia(User::DOCUMENTS_COLLECTION2);
        $this->form->fill([
            'name' => auth()->user()->name,
            'surname' => auth()->user()->surname,
            'email' => auth()->user()->email,
            'phone' => auth()->user()->phone,
            'avatar' => $media?->getUrl(),
            'document1' => $document1?->getUrl(),
            'document2' => $document2?->getUrl(),
        ]);
    }

    protected function getFormModel(): string
    {
        return User::class;
    }

    protected function getFormSchema(): array
    {
        return [
            SpatieMediaLibraryFileUpload::make('avatar')
                ->label('Avatar')
                ->placeholder('Upload your avatar')
                ->required()
                ->avatar()
                ->image()
                ->imageEditor()
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
            Grid::make('4')->schema([
                SpatieMediaLibraryFileUpload::make('document1')
                    ->label('Select CNIC')->columnSpan(2)->image(),
                SpatieMediaLibraryFileUpload::make('document2')
                    ->label('Select Passport')->columnSpan(2)
                    ->acceptedFileTypes(['application/pdf']),
            ])
        ];
    }
}
