<?php

namespace App\Infra\Common\AuthorizationTransaction;

use App\Infra\Common\Adapters\AdapterHandlerInterface;

class AuthorizationAdapter implements AdapterHandlerInterface
{

    public function getAdapter()
    {
        return new GenericAuthorizationTransaction();
    }
}
