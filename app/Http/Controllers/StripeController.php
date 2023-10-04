<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Cashier\Cashier;
use Stripe\PaymentIntent;

class StripeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $unit = 12;
        $product = \Session::get('product');
        $user = auth()->user();
        $stripeSecretKey = config('services.stripe.secret_key');
        \Stripe\Stripe::setApiKey($stripeSecretKey);
        header('Content-Type: application/json');


        $url = $user->checkoutCharge(
            $product->price,
            $unit
        );
        return redirect($url->url);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function checkOut()
    {
        return view('checkout.checkout');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function checkoutDetails(Request $request)
    {
        dd($request->all());
    }


    /**
     * Display the specified resource.
     */
    public function topUpWallet(Request $request)
    {
        $amount = $request['amount'];
        $user = auth()->user();
        $stripeSecretKey = config('services.stripe.secret_key');
        \Stripe\Stripe::setApiKey($stripeSecretKey);
        header('Content-Type: application/json');
        $url = $user->checkoutCharge(
            amount: $amount,
            name: 'myWallet',
            sessionOptions: [
                'payment_method_types' => ['card'],
                'success_url' => url('panel/wallet'),
                'cancel_url' => route('user.profile'),
                'submit_type' => 'book',
            ],
            productData: [
                'metadata' => [
                    'description' => 'Top_Up_Wallet',
                ]
            ]
        );
       return redirect($url->url);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
