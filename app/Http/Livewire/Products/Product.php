<?php

namespace App\Http\Livewire\Products;

use Filament\Forms\Components\Card;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Notifications\Notification;
use Livewire\Component;

class Product extends Component implements HasForms
{
    use InteractsWithForms;

    public string $name = '';
    public string $price = '';
    public string $description = '';
    public $image;


    public function render()
    {
        return view('livewire.products.product');
    }
    public function getFormSchema(): array
    {
        return [
            Grid::make()->schema([

                Card::make()
                    ->schema([
                        TextInput::make('name')->label('Name'),
                        TextInput::make('price')->label('Price'),
                        Textarea::make('description')->label('Description'),
                    ])->columnSpan(1),
                Card::make()
                    ->schema([
                        FileUpload::make('image')->label('Image')
                            ->imagePreviewHeight('250')
                            ->loadingIndicatorPosition('left')
                            ->panelAspectRatio('2:1')
                            ->panelLayout('integrated')
                            ->removeUploadedFileButtonPosition('right')
                            ->uploadButtonPosition('left')
                            ->uploadProgressIndicatorPosition('left'),
                    ])->columnSpan(1),
            ])
        ];
    }

    public function submit(): void
    {
        auth()->user()->products()->create([
            'name' =>$this->name,
            'price' =>$this->price,
            'description' =>$this->description,
            'image' => $this->getImage()

        ]);

        Notification::make()->title('Success')->body('Product create successfully')->success()->send();
    }

    public function getImage(): string|null
    {
        if (isset($this->image)) {
            $image = collect($this->image)->map(static fn($file) => $file->store('products'))->first();
        } else {
            $image = 'products/default.png';
        }
        return $image;

    }
    protected function getFormModel(): string
    {
        return \App\Models\Product::class;
    }
}
