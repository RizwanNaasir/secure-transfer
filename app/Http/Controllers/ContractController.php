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
        return ContractService::create($request->all(), $request->user());
    }

    public function list()
    {
        $contracts = auth()->user()->contracts()->with('status', 'recipient')->get();
        return view('history.index', compact('contracts'));
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

        $tempUser = $this->getUserVia(email: $request->get('recipient_email'));
        if (!is_null($tempUser)) {
            Notification::make()
                ->title('Registration Required')
                ->body('You need to register before you can perform any actions.')
                ->warning()
                ->send();
            return view('user.register', compact('tempUser'));
        }

        ContractService::acceptContract($request);

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
        $recipient = $contract->recipient->first();
        return view('history.detail', compact('contract', 'recipient'));
    }
}
