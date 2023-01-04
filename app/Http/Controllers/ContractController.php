<?php

namespace App\Http\Controllers;

use App\Models\Contract;
use App\Models\User;
use App\Services\ContractService;
use Filament\Notifications\Notification;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class ContractController extends Controller
{
    public function store(Request $request)
    {
        return ContractService::create($request->all(), auth()->user());
    }

    public function list($tab = 'sent')
    {
        if (!in_array($tab, ['sent', 'received'])) {
            Notification::make()->title('Invalid tab')->warning()->send();
            return redirect(url('/'));
        }
        return view('history.index', [
            'tab' => $tab,
        ]);
    }

    public function view(Request $request)
    {
        try {
            $request->validate(['recipient_id' => 'required|int'], ['recipient_id']);
        } catch (ValidationException $e) {
            return $this->error(message: $e->getMessage());
        }
        $contracts = $request
            ->user()
            ->findContractWith($request->get('recipient_id'))
            ->get();
        return view('history.index', ['contracts', $contracts]);
    }

    public function viewContractForm()
    {
        return view('contract.add-contract');
    }

    public function process(Request $request)
    {
        $contract = Contract::query()->where('id', $request->get('contract_id'))
            ->firstOrFail();
        if (!$contract->is_pending) {
            Notification::make()
                ->title('Contract Resolved')
                ->body('Contract Already Resolved')
                ->warning()
                ->send();
            return route('home');
        }
        $tempUser = $this->getUserVia(email: $request->get('recipient_email'));
        if (!is_null($tempUser)) {
            Notification::make()
                ->title('Registration Required')
                ->body('You need to register before you can perform any actions.')
                ->warning()
                ->send();
            return view('user.register', compact('tempUser'));
        }

        return view('contract.accept-contract', compact('contract'));
    }

    public function getUserVia(string $email): object|null
    {
        return User::query()
            ->where(['email' => $email])
            ->whereNull('password')
            ->first();
    }

    public function details(Contract $contract)
    {
        $contract = $contract->load('status', 'recipient', 'user');
        (bool)$fromSender = \request()->get('from-sender');
        $recipient = $fromSender ? $contract->user->first() : $contract->recipient->first();
        session()->put('contract_id', $contract->id);
        return view('history.detail', compact('contract', 'recipient', 'fromSender'));
    }

    public function acceptContract(Contract $contract)
    {
        if ($contract->current_status === 'Accepted') {
            /*return $this->success(message: 'Contract already accepted');*/
            Notification::make()->title('Contract')->body('Contract already accepted')->success()->send();
            return redirect(url('contract/list/received'));
        } else {
            ContractService::updateContract($contract, 'accepted');
            /*return $this->success(message: 'Contract accepted');*/
            Notification::make()->title('Contract')->body('Contract accepted')->success()->send();
//            dd($contract->id);
//            session()->put('contract_id', $contract->id);
            return redirect(url('contract/list/received'));
        }
    }

    public function declineContract(Contract $contract)
    {
        if ($contract->current_status === 'Declined') {
            return $this->success(message: 'Contract already declined');
        } else {
            ContractService::updateContract($contract, 'declined', \request()->get('description'));
            return $this->success(message: 'Contract declined');
        }
    }
}
