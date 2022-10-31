<?php

namespace App\Http\Controllers;

use App\Services\ContractService;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class ContractController extends Controller
{
    public function store(Request $request)
    {
        return ContractService::create($request->all(),$request->user());
    }
    public function list()
    {
        $contracts = auth()->user()->contracts()->with('status','recipient')->get();
        return view('history.index',compact('contracts'));
    }
    public function view(Request $request)
    {
        try {
            $request->validate(['recipient_id'=>'required|int'],['recipient_id']);
        }catch (ValidationException $e){
            return $this->error(message: $e->getMessage());
        }
        $contracts = $request
            ->user()
            ->findContractWith($request->get('recipient_id'))
            ->get();
        return view('history.index',['contracts',$contracts]);
    }

}
