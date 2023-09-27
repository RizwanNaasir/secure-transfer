<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\ContractListResource;
use App\Models\Contract;
use Illuminate\Contracts\Database\Eloquent\Builder;

class DashBoardController extends Controller
{
    public function __invoke()
    {
        $user = request()->user();
        $currentActiveContract = $user
            ->allContracts()
            ->with('status')
            ->latest()
            ->pending()
            ->first();

        return $this->success([
            'totalNumberOfContracts' => $user
                ->allContracts()
                ->count(),
            'totalAmountReceived' => $user
                ->receivedContracts()
                ->notPending()
                ->sum('amount'),
            'totalAmountSent' => $user
                ->contracts()
                ->notPending()
                ->sum('amount'),
            'currentActiveContract' => isset($currentActiveContract) ? [
                'amount' => $currentActiveContract->amount,
                'status' => ucfirst($currentActiveContract->status->status)
            ] : null,
            'activeContracts' => ContractListResource::collection(
                Contract::query()
                    ->with('status')
                    ->whereHas('user', function (Builder $query) {
                        return $query
                            ->where('user_id', auth()->id())
                            ->orWhere('recipient_id', auth()->id());
                    })->notPending()->paginate(5)->items()
            )
        ]);
    }
}
