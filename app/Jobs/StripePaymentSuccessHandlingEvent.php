<?php

namespace App\Jobs;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Spatie\WebhookClient\Models\WebhookCall;

class StripePaymentSuccessHandlingEvent implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct(protected WebhookCall $webhookCall)
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
            if ($this->webhookCall->payload['data']['object']['payment_status'] === 'paid' && $this->webhookCall->payload['data']['object']['submit_type'] === 'book') {
            $customer = $this->webhookCall->payload['data']['object']['customer'];
            $amount = $this->webhookCall->payload['data']['object']['amount_total'];
            $user = User::where('stripe_id',$customer)->first();
            $user->deposit($amount);
        }
    }
}
