<?php

namespace App\Livewire\Products;

use Filament\Tables\Actions\Action;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Livewire\Component;

class ProductList extends Component implements HasTable
{
    use InteractsWithTable;
    public function render()
    {
        return view('livewire.products.product-list');
    }
    protected function getTableQuery(): Builder
    {
        return \App\Models\Product::query()->where('user_id',auth()->id());
    }
    protected function getTableColumns(): array
    {
        return [
            TextColumn::make('name'),
            TextColumn::make('price'),
            TextColumn::make('description'),
            IconColumn::make('approved')
                ->boolean(),
            ImageColumn::make('full_image'),
        ];
    }

    protected function getTableActions(): array
    {
        return [

            Action::make('edit')
                ->url(fn (\App\Models\Product $record): string => route('user.product.edit', ['product' => $record])),
            \Filament\Tables\Actions\DeleteAction::make()
        ];
    }

}
