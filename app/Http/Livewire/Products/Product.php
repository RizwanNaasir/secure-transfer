<?php

namespace App\Http\Livewire\Products;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Livewire\Component;

class Product extends Component implements HasForms
{
    use InteractsWithForms;

    public function render()
    {
        return view('livewire.products.product');
    }

    public function getFormSchema(): array
    {
        return [
            Grid::make()->schema([
                TextInput::make('name')->label('Name'),
                TextInput::make('price')->label('Price'),
                TextInput::make('description')->label('Description'),
                FileUpload::make('image')->label('Image'),
            ])
        ];
    }

    public function submit()
    {
       dd($this->form-getstate());
    }
}
