<?php

namespace App\Domain\Application\Transaction\Exceptions;

class NotAuthorizedException extends \Exception
{
    public function __construct(string $message = "Operação não permitida para este usuário", int $code = 0, ?Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
