<?php

namespace App\Http\Livewire;

use Livewire\Component;
use LivewireUI\Modal\ModalComponent;

class ChangePassword extends ModalComponent
{
    public function render()
    {
        return view('livewire.change-password');
    }
}
