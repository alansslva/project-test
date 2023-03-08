<?php

namespace App\Domain\Application\Transaction\Entities\Interfaces;

use App\Infra\Application\User\Entities\Interfaces\UserInterface;

interface TransactionInterface
{
    public function getUserTo() : UserInterface;
    public function getUserFrom() : UserInterface;
    public function getValue() : string;
}
