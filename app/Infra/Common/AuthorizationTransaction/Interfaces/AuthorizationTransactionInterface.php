<?php

namespace App\Infra\Common\AuthorizationTransaction\Interfaces;

interface AuthorizationTransactionInterface
{
    public function authorize() : bool;
}
