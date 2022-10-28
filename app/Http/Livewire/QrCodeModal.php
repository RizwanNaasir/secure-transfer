<?php

namespace App\Http\Livewire;

use Livewire\Component;
use LivewireUI\Modal\ModalComponent;

class QrCodeModal extends ModalComponent
{
    public function render()
    {
        return view('livewire.qr-code-modal');
    }
}
