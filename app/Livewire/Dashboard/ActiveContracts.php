<?php

namespace App\Livewire\Dashboard;

use App\Filament\Resources\ContractResource;
use App\Models\Contract;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Livewire\Component;

class ActiveContracts extends Component implements HasTable
{
    use InteractsWithTable;

    protected function getTableQuery(): Builder
    {
        return Contract::query()->whereHas('user',function (Builder $query){
            return $query
                ->where('user_id',auth()->id())
                ->orWhere('recipient_id',auth()->id());
        })->notPending();
    }

    public function render()
    {
        return view('livewire.dashboard.active-contracts');
    }

    protected function getTableColumns(): array
    {
        return ContractResource::getTableColumns();
    }
}
