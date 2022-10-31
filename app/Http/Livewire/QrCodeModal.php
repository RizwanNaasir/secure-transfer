<?php

namespace App\Http\Livewire;

use App\Models\Contract;
use LivewireUI\Modal\ModalComponent;

class QrCodeModal extends ModalComponent
{

    public $contract;

    public static function modalMaxWidth(): string
    {
        return 'lg';
    }
    public function mount()
    {
        $this->contract = Contract::query()->find(session()->get('contract_id'));
    }

    public function save()
    {
        //download qr code

    }

    public function render()
    {
        return view('livewire.qr-code-modal', [
            'qrCode' => $this->contract->status->qr_code,
            'contract' => $this->contract,
        ]);
    }
}
