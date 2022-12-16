Introduction

Dear {{$recipient->full_name}},

We are herby to inform you that you have entered into a new contract with {{$sender->full_name}} for Payment of {{$contract->description}}
. As part of this agreement, you have agreed upon a payment of {{ $contract->currency }} {{ $contract->amount }} to be made via {{ucfirst($contract->preferred_payment_method)}}.

Here is copy of qr_code that you can scan to accept this contract.

{!! $contract->status->qr_code !!}

Thank you for your interest. If you have any questions or concerns regarding the payment terms, please do contact us.

Sincerely,

From {{$sender->full_name}}

Thanks,<br>
{{ config('app.name') }}