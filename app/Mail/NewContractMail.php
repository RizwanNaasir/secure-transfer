<?php

namespace App\Mail;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NewContractMail extends Mailable
{
    use Queueable, SerializesModels;


    public function __construct(
        private readonly Model|Builder        $contract,
        private readonly User|Authenticatable $user,
        private readonly User                 $recipient)
    {
    }

    public function build(): self
    {
        return $this->view('emails.new-contract', [
            'contract' => $this->contract,
            'sender' => $this->user,
            'recipient' => $this->recipient,
        ]);
    }
}