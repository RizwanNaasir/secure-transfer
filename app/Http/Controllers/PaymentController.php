<?php

namespace App\Http\Controllers;

use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class PaymentController extends Controller
{
    public function headers()
    {
        $response = Http::withHeaders ([
            'accept' => 'application/json',
            'X-CC-Api-Key' => '9ffb2560-2929-42a6-99c0-949ae3303f0d',
            'X-CC-Version' => '2018-03-22'
        ]);

        return $response;
   }
    public function paymentMethod()
    {
        $responses = $this->headers()->acceptJson()->post('https://api.commerce.coinbase.com/charges', [
            'local_price' => [
                'amount' => 20,
                'currency' => 'USD',
            ],
            'metadata' => [
                'customer_id' => 'fffeeeddd',
                'customer_name' => 'zaman',
            ],
            'name' => 'ali',
            'description' => 'new transaction',
            'pricing_type' => 'fixed_price',
            'redirect_url' => 'https://charge/completed/page',
            'cancel_url' => 'https://charge/canceled/page',
        ]);
        $data = $responses['data'];

        return $data;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function showCharge()
    {
        $charge_id = $this->paymentMethod();
        $id = $charge_id['code'];

        $show_charge = $this->headers()->acceptJson()->get('https://api.commerce.coinbase.com/charges/'.$id);

        $show_charges = [
            'id' => $id,
            'name' => $show_charge['data']['metadata']['customer_name'],
            'description' => $show_charge['data']['description'],
            'pricing_type' => $show_charge['data']['pricing_type'],
            'pricing' => $show_charge['data']['pricing'],

        ];
        dd($show_charge->object());

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
