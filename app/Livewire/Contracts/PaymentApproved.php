<?php

namespace App\Livewire\Contracts;

use LivewireUI\Modal\ModalComponent;

class PaymentApproved extends ModalComponent
{
//    public static function closeModalOnEscape(): bool
//    {
//        return false;
//    }
//
//    public static function closeModalOnClickAway(): bool
//    {
//        return false;
//    }
    public function render()
    {
        return view('livewire.contracts.payment-approved');
    }
}
