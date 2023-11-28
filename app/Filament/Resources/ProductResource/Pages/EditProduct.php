<?php

namespace App\Filament\Resources\ProductResource\Pages;

use _PHPStan_7c8075089\React\Dns\Model\Record;
use App\Filament\Resources\ProductResource;
use Filament\Pages\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Support\Facades\DB;

class EditProduct extends EditRecord
{
    protected static string $resource = ProductResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make()->action(function (){
               DB::table('contract_product')
                ->where('product_id', $this->record->id)
                ->delete();
                $this->record->delete();
                $this->redirect(ProductResource::getUrl());
            }),
        ];
    }
}
