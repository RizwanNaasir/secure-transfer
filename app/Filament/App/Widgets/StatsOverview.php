<?php

namespace App\Filament\App\Widgets;

use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverview extends BaseWidget
{
    protected function getStats(): array
    {
        $user = auth()->user();
        $totalNumberOfContracts = $user->allContracts()->count();
        $totalAmountReceived = $user->receivedContracts()
            ->notPending()
            ->sum('amount');
        $currentActiveContract = $user->allContracts()
            ->latest()
            ->pending()
            ->first()
            ->load('status');
        $totalAmountSent = $user->contracts()
            ->notPending()
            ->sum('amount');
        return [
            Stat::make('Current Active Contracts', "$currentActiveContract->amount $")
                ->description(ucfirst($currentActiveContract->status->status))
                ->color(match ($currentActiveContract->status->status) {
                    'pending' => 'warning',
                    'accepted' => 'success',
                    'rejected' => 'danger',
                    default => 'primary',
                }),
            Stat::make('Total amount Received', "$totalAmountReceived $")
                ->color('danger'),
            Stat::make('Total # of Contacts', $totalNumberOfContracts)
                ->descriptionIcon('heroicon-m-arrow-trending-up')
                ->color('success'),
            Stat::make('Total amount Sent', "$totalAmountSent $"),
        ];
    }
}
