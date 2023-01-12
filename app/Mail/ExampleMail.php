<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ExampleMail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(protected string $email)
    {
    }

    public function build(): self
    {
        return $this->view('emails.example')->to($this->email);
    }
}