<?php

namespace App\Domain\Application\Transaction\Exceptions;

class NotEnoughValueException extends \Exception
{
    public function __construct(string $message = "Saldo insuficiente para realizar essa operação", int $code = 0, ?Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
