<?php

namespace App\Http\Controllers;

use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use function Symfony\Component\String\s;

class PaymentController extends Controller
{
    public function headers()
    {
        $response = Http::withHeaders([
            'accept' => 'application/json',
            'X-CC-Api-Key' => '9ffb2560-2929-42a6-99c0-949ae3303f0d',
            'X-CC-Version' => '2018-03-22'
        ]);

        return $response;
    }

    public function createCharge()
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


    public function showCharge()
    {
        $charge_id = $this->createCharge();
        $id = $charge_id['code'];

        $show_charge = $this->headers()->acceptJson()->get('https://api.commerce.coinbase.com/charges/' . $id);

        $show_charges = [
            'id' => $show_charge['data']['id'],
            'code' => $show_charge['data']['code'],
            'resource' => $show_charge['data']['resource'],
            'name' => $show_charge['data']['name'],
            'description' => $show_charge['data']['description'],
            'pricing_type' => $show_charge['data']['pricing_type'],
            'pricing' => $show_charge['data']['pricing'],
            'cancel_url' => $show_charge['data']['cancel_url'],
            'redirect_url' => $show_charge['data']['redirect_url'],


        ];
        dd($show_charges);

    }


    public function listCharges()
    {
       $lists = $this->headers()->acceptJson()->get('https://api.commerce.coinbase.com/charges');
       $list = $lists->object();
       dd($list);

    }

    public function cancelCharges()
    {
        $charge_id = $this->createCharge();
        $code = $charge_id['code'];
       $canceling = $this->headers()->acceptJson()->post('https://api.commerce.coinbase.com/charges/'.$code.'/cancel');
       $cancel = $canceling->object();
       dd($cancel);

       return $cancel;
    }

    public function resolveCharges()
    {
        $charge_id = $this->createCharge();
        $code = $charge_id['code'];

        $resolveCharges = $this->headers()->acceptJson()->post('https://api.commerce.coinbase.com/charges/'.$code.'/resolve');
        dd($resolveCharges->object());
    }
    public function listCheckout()
    {
        $checkoutlist = $this->headers()->acceptJson()->get('https://api.commerce.coinbase.com/checkouts');
        dd($checkoutlist->object());
    }

    public function createCheckout()
    {
        $responses = $this->headers()->acceptJson()->post('https://api.commerce.coinbase.com/checkouts', [
            'local_price' => [
                'amount' => 20,
                'currency' => 'USD',
            ],
            'requested_info' => [
                        'email',
                        'name' ,
                        'address'
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
        $data = $responses;

        return $data->body();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
