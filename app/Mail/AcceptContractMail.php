<?php

namespace App\Mail;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class AcceptContractMail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(
        private readonly Model|Builder        $contract,
        private readonly User|Authenticatable $user,
        private readonly User                 $recipient
    )
    {
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Accept Contract',
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.accept-contract',
        );
    }

    public function attachments(): array
    {
        return [];
    }

    public function build(): self
    {
        return $this->view('emails.accept-contract', [
            'contract' => $this->contract,
            'sender' => $this->user,
            'recipient' => $this->recipient,
        ]);
    }
}
