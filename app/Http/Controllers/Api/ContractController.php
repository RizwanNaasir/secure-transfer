<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ContractRequest;
use App\Models\Contract;
use App\Services\ContractService;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class ContractController extends Controller
{
    public function store(ContractRequest $request)
    {
        try {
              return  $this->success(
                  message: 'çontract add successfully',
                  data: ContractService::create($request->all(), $request->user()));
            }
         catch (\Exception $e) {
            return $this->error($e->getMessage(), 400);
        }



    }

    public function contractlist(Request $request)
    {

        $list_received = request()
            ->user()
            ->receivedContracts()
            ->get();

        $list_send = request()
            ->user()
            ->contracts()
            ->get();
        return $this->success(data: [
            'list_received' => $list_received,
            'list_send' => $list_send,
        ]);
    }

    public function contractDetails(Contract $contract)
    {
        (bool)$fromSender = \request()->get('from-sender');

        $recipient = $fromSender ? $contract->user->first() : $contract->recipient->first();

        if ($fromSender == 0) {
            return $this->success(data: [
                'contract' => $contract,
                'from_recipient' => $recipient,
            ]);
        } else {
            return $this->success(data: [
                'contract' => $contract,
                'from_sender' => $recipient,
            ]);
        }
    }

    public function acceptContract(Contract $contract)
    {
        if ($contract->current_status === 'Accepted')
        {
            return $this->success(message: 'Contract already accepted');
        }
        else
        {
            ContractService::updateContract($contract, 'accepted');
            return $this->success(message: 'Contract accepted');
        }
    }

    public function declineContract(Contract $contract)
    {
        if ($contract->current_status === 'Declined')
        {
            return $this->success(message: 'Contract already declined');
        }
        else
        {
            ContractService::updateContract($contract, 'declined',\request()->get('description'));
            return $this->success(message: 'Contract declined');
        }
    }
}
