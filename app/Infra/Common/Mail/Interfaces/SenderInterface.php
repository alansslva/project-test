<?php

namespace App\Infra\Common\Mail\Interfaces;

interface SenderInterface
{
    public function setRecipient(string $recipient) : void;
    public function setMessage(string $message) : void;
    public function sendMessage() : bool;
}
