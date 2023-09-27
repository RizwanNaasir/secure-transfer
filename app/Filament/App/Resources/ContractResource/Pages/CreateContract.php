<?php

namespace App\Filament\App\Resources\ContractResource\Pages;

use App\Filament\App\Resources\ContractResource;
use App\Models\Contract;
use App\Models\Product;
use App\Services\ContractService;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Database\Eloquent\Model;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;

class CreateContract extends CreateRecord
{
    protected static string $resource = ContractResource::class;

    /**
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    protected function handleRecordCreation(array $data): Model
    {
        $product = isset($data['product']) ? Product::find($data['product']) : null;
        ContractService::create($data, auth()->user(), $product);
        return Contract::find(session()->get('contract_id'));
    }
}
