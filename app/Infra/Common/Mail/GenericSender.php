<?php

namespace App\Infra\Common\Mail;

use App\Infra\Common\Http\Http;
use App\Infra\Common\Mail\Interfaces\SenderInterface;

class GenericSender extends Http implements SenderInterface
{

    protected string $recipient;
    protected string $message;

    public function setRecipient(string $recipient): void
    {
      $this->recipient = $recipient;
    }

    public function setMessage(string $message): void
    {
        $this->message = $message;
    }

    public function sendMessage(): bool
    {
        $response =  json_decode($this->get('http://o4d9z.mocklab.io/notify'), true);
        if($response['message'] == 'Success')
            return true;

        return false;
    }
}
