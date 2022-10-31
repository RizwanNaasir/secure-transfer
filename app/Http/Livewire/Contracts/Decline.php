<?php

namespace App\Http\Livewire\Contracts;

use LivewireUI\Modal\ModalComponent;

class Decline extends ModalComponent
{
    public function render()
    {
        return view('livewire.contracts.decline');
    }

    public function submit()
    {
        $this->closeModal();
    }
}
