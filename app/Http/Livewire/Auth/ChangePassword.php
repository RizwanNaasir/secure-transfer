<?php

namespace App\Http\Livewire\Auth;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Notifications\Notification;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use LivewireUI\Modal\ModalComponent;

class ChangePassword extends ModalComponent implements HasForms
{
    use InteractsWithForms;

    public string $old_password = '';
    public string $new_password = '';
    public string $new_password_confirmation = '';

    /**
     * @throws ValidationException
     */
    public function submit()
    {
        $this->validate([
            'old_password' => ['required', 'string',function ($attribute, $value, $fail) {
                if (!Hash::check($this->old_password, auth()->user()->password)) {
                    return $fail(__('The current password is incorrect.'));
                }else{
                    return true;
                }
            }],
            'new_password' => ['required', 'string', 'min:6', 'confirmed'],
        ]);
        auth()->user()->update([
            'password' => bcrypt($this->new_password),
        ]);
        $this->closeModal();
        Notification::make()->title('Password changed successfully')->success()->send();
    }

    public function render()
    {
        return view('livewire.auth.change-password');
    }

    protected function getFormSchema(): array
    {
        return [
            TextInput::make('old_password')
                ->required()
                ->password()
                ->placeholder('Old Password'),
            TextInput::make('new_password')
                ->required()
                ->password()
                ->confirmed()
                ->placeholder('New Password'),
            TextInput::make('new_password_confirmation')
                ->required()
                ->password()
                ->placeholder('Confirm Password'),
        ];
    }
}
