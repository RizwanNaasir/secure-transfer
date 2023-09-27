<?php

namespace App\Filament\App\Widgets;

use App\Filament\App\Resources\ContractResource;
use App\Models\Contract;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;
use Illuminate\Database\Eloquent\Builder;

class ActiveContractWidget extends BaseWidget
{
    protected static ?int $sort = 2;

    protected int|string|array $columnSpan = 2;

    public function table(Table $table): Table
    {
        return $table
            ->query(Contract::query()
                ->whereHas('status', function (Builder $query) {
                    return $query->where('status', '==', 'accepted');
                })
                ->whereHas('user', function (Builder $query) {
                    return $query->where('user_id', auth()->id());
                })->orWhereHas('recipient', function (Builder $query) {
                    return $query->where('recipient_id', auth()->id());
                }))
            ->columns(ContractResource::getContractColumns());
    }
}
