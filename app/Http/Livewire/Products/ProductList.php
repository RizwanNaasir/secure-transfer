<?php

namespace App\Http\Livewire\Products;

use Filament\Pages\Actions\DeleteAction;
use Filament\Pages\Actions\EditAction;
use Filament\Tables\Actions\Action;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Livewire\Component;
use Nette\Utils\Image;

class ProductList extends Component implements HasTable
{
    use InteractsWithTable;
    public function render()
    {
        return view('livewire.products.product-list');
    }
    protected function getTableQuery(): Builder
    {
        return \App\Models\Product::query();
    }
    protected function getTableColumns(): array
    {
        return [
            TextColumn::make('name'),
            TextColumn::make('price'),
            TextColumn::make('description'),
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
