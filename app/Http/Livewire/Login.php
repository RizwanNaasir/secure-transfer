<?php

namespace App\Http\Livewire;

use LivewireUI\Modal\ModalComponent;

class Login extends ModalComponent
{
    public function render()
    {
        return view('livewire.login');
    }
}
