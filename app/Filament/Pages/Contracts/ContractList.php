<?php

namespace App\Filament\Pages\Contracts;

use App\Models\Contract;
use Filament\Forms\Components\Select;
use Filament\Pages\Page;
use Filament\Tables\Columns\BadgeColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Filters\Filter;
use Illuminate\Database\Eloquent\Builder;
use Filament\Tables\Filters\SelectFilter;

class ContractList extends Page implements HasTable
{
    use InteractsWithTable;

    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static string $view = 'filament.pages.contracts.contract-list';

    protected static ?string $navigationGroup = 'Contracts';




    protected function getTableQuery(): Builder
    {
        return Contract::query();
    }

    public function getTableColumns(): array
    {
        return [
            TextColumn::make('id'),
            TextColumn::make('amount')->icon('heroicon-s-currency-dollar'),
            TextColumn::make('description'),
            BadgeColumn::make('status.status')
                ->colors([
                    'warning' => 'pending',
                    'success' => 'accepted',
                    'danger' => 'declined',
                ])
                ->formatStateUsing(static fn(string $state): string => ucfirst($state)),
//            TextColumn::make('user.full_name'),
            TextColumn::make('user.email')->label('Sender')->limit(12),
//            TextColumn::make('recipient.full_name'),
            TextColumn::make('recipient.email')->label('Recipient')->limit(12),
            TextColumn::make('preferred_payment_method')
                ->formatStateUsing(static fn(string $state): string => ucfirst($state)),
        ];
    }

    /**
     * @throws \Exception
     */
    protected function getTableFilters(): array
    {
        return [
            Filter::make('status')
                ->form([
                    Select::make('status')->options([
                        'all' => 'All',
                        'pending' => 'Pending',
                        'accepted' => 'Accepted',
                        'declined' => 'Declined',
                    ])->default('all')
                ])
                ->query(static function (Builder $query, array $data): Builder {
                    return $query
                        ->when($data['status'] == 'all', static function (Builder $q) use ($data,$query ) {
                            return $q;
                        })
                        ->when($data['status'] != 'all', static function ($q) use ($data) {
                            return $q->whereHas('status', static function ($q) use ($data) {
                                return $q->where(['status' => $data]);
                            });
                        });
                })
        ];
    }
}
