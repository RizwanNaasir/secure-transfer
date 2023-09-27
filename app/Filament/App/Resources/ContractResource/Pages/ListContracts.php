<?php

namespace App\Filament\App\Resources\ContractResource\Pages;

use App\Filament\App\Resources\ContractResource;
use Filament\Actions;
use Filament\Resources\Components\Tab;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Database\Eloquent\Builder;

class ListContracts extends ListRecords
{
    protected static string $resource = ContractResource::class;

    public function getTabs(): array
    {
        return [
            'all' => Tab::make(),
            'sent' => Tab::make()
                ->icon('heroicon-o-inbox')
                ->modifyQueryUsing(function (Builder $query) {
                    return $query->whereHas('user', function (Builder $query) {
                        return $query->where('user_id', auth()->id());
                    });
                }),
            'received' => Tab::make()
                ->icon('heroicon-o-inbox-arrow-down')
                ->modifyQueryUsing(function (Builder $query) {
                    return $query->whereHas('recipient', function (Builder $query) {
                        return $query->where('recipient_id', auth()->id());
                    });
                }),
        ];
    }

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
