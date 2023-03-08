<?php

namespace App\Infra\Common\Mail;

use App\Infra\Common\Mail\Interfaces\SenderInterface;

class GenericSender implements SenderInterface
{

    public function setRecipient(string $recipient): void
    {
        // TODO: Implement setRecipient() method.
    }

    public function setMessage(string $message): void
    {
        // TODO: Implement setMessage() method.
    }

    public function sendMessage(): bool
    {
        // TODO: Implement sendMessage() method.
    }
}
