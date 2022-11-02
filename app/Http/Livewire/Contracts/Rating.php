<?php

namespace App\Http\Livewire\Contracts;

use Livewire\Component;
use LivewireUI\Modal\ModalComponent;

class Rating extends ModalComponent
{
    public function render()
    {
        return view('livewire.contracts.rating');
    }
}
