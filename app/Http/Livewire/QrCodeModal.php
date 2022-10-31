<?php

namespace App\Http\Livewire;

use App\Models\Contract;
use LivewireUI\Modal\ModalComponent;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class QrCodeModal extends ModalComponent
{

    public $qrCode;

    public function mount()
    {
        $this->qrCode = Contract::query()->find(session()->get('contract_id'))->status->qr_code;
    }

    public function render()
    {
        return view('livewire.qr-code-modal', [
            'qrCode' => $this->qrCode
        ]);
    }
}
