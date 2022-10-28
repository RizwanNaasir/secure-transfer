<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\ContractService;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class ContractController extends Controller
{
    public function store(Request $request)
    {
        return ContractService::create($request->all(),$request->user());
    }

    public function view(Request $request)
    {
        try {
            $request->validate(['recipient_id'=>'required|int'],['recipient_id']);
        }catch (ValidationException $e){
            return $this->error(message: $e->getMessage());
        }
        return $request
            ->user()
            ->findContractWith($request->get('recipient_id'))
            ->get();
    }
}
