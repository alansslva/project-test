<?php

namespace App\Infra\Common\Mail;

use App\Infra\Common\Adapters\AdapterHandlerInterface;

class EmailAdapter implements AdapterHandlerInterface
{
    public function getAdapter()
    {
        return new GenericSender();
    }
}
