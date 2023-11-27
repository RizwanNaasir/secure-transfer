<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\BankDetailRequest;
use App\Http\Requests\CancelPayoutRequest;
use App\Http\Requests\PayoutRequest;
use App\Http\Resources\Api\PayoutRequestResource;
use App\Http\Resources\Api\TransactionResource;
use App\Models\PayoutRequest as ModelsPayoutRequest;
use App\Http\Resources\Api\BankDetailResource;
use App\Models\BankDetail;
use Bavix\Wallet\Models\Transaction;
use Illuminate\Http\Request;
use Laravel\Cashier\Cashier;
use Stripe\Exception\ApiErrorException;
use Stripe\PaymentIntent;
use Stripe\Stripe;

class StripeController extends Controller
{
    public function submitRequest(PayoutRequest $request)
    {
        $user = auth()->user();
        $user->withdraw($request->input('amount'));

        ModelsPayoutRequest::query()
            ->create(
                [
                    'user_id' => auth()->user()->id,
                    'bank_detail_id' => $request->input('bank_detail_id'),
                    'amount' => $request->input('amount'),
                ],
            );

        return $this->success(
            data: [
                'message' => 'Payout request submitted successfully',
            ],
        );
    }

    public function cancelSubmitRequest(CancelPayoutRequest $request)
    {
        $payoutRequest = ModelsPayoutRequest::query()
            ->find($request->input('payout_request_id'));
        $user = auth()->user();
        $user->deposit($payoutRequest->amount);
       $payoutRequest->update(['status' => 'declined']);

        return $this->success(
            data: [
                'message' => 'Payout request cancel successfully',
            ],
        );
    }

    public function requestDetails()
    {
        $payoutData = PayoutRequestResource::collection(ModelsPayoutRequest::query()
            ->where('user_id',auth()->user()->id)
            ->get());
        return $this->success(
            data: [
                'payout_request' => $payoutData,
            ],
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(BankDetailRequest $request)
    {
        BankDetail::query()->
        updateOrCreate(
            [
            'user_id' => auth()->user()->id,
            ],
        [
            'account_holder_name' => $request->input('account_holder_name'),
            'bank_name' => $request->input('bank_name'),
            'account_number' => $request->input('account_number'),
        ]
        );

        return $this->success(
            data: [
            'message' => 'Bank details updated successfully',
            ],
        );
    }

    /**
     * Display the specified resource.
     */
    public function show()
    {
        $bankDetails = BankDetailResource::collection(BankDetail::query()
            ->where('user_id',auth()->user()->id)
            ->get()
        );
        return $this->success(
            data: $bankDetails,
        );
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function balanceTransaction()
    {
        $user = auth()->user();

        $transaction = TransactionResource::collection($user->transactions()->get());
        return $this->success(
            data: [
                'current balance' => $user->balanceInt,
                'latest Transaction' => $transaction
            ],
        );
    }

    /**
     * Update the specified resource in storage.
     * @throws ApiErrorException
     */
    public function paymentIntend(Request $request)
    {
        Stripe::setApiKey(config('services.stripe.secret_key'));
        $user = $request->user();
        $stripeCustomerId = $user?->stripe_id;
        if (!$stripeCustomerId) {
            $stripeCustomer = \Stripe\Customer::create([
                'email' => $user->email,
            ]);
            $user->update([
                'stripe_id' => $stripeCustomer->id,
            ]);
        }
            $customer = $stripeCustomerId;
            $ephemeralKey = \Stripe\EphemeralKey::create(
                ['customer' => $customer],
                ['stripe_version' => '2020-08-27']
            );
            $intent = PaymentIntent::create([
                'amount' => $request->input('amount')*100,
                'currency' => 'usd',
                'customer' => $customer,
            ]);
            return $this->success(
                data: [
                    'payment_intent' => $intent->client_secret,
                    'customer_id' => $customer,
                    'ephemeral_key' => $ephemeralKey->secret
                ],
            );
    }

    /**
     * Remove the specified resource from storage.
     */
    public function confirmTransaction(Request $request)
    {
        $user = $request->user();
        $amount = $request->input('amount', 0);
        $user->deposit($amount);
    }
}
