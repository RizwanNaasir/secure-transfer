<?php

namespace App\Livewire;

use Filament\Actions\Action;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class WalletOverview extends BaseWidget
{
    protected function getTableHeaderActions(): array
    {
        return [
            Action::make('edit')
                ->url(route('stripe.top-up-wallet'))
        ];
    }
    protected function getStats(): array
    {
        $user = auth()->user();
        return [
            Stat::make('Wallet Amount', ' $ '.$user->balanceInt),
            Stat::make('Bounce rate', '21%'),
        ];
    }
}
