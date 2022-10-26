<?php

namespace App\Http\Livewire;

use Livewire\Component;
use LivewireUI\Modal\ModalComponent;

class ForgetPassword extends ModalComponent
{
    public function render()
    {
        return view('livewire.forget-password');
    }
}
