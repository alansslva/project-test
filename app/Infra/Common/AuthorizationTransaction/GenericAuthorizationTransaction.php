<?php

namespace App\Infra\Common\AuthorizationTransaction;

use App\Infra\Common\AuthorizationTransaction\Interfaces\AuthorizationTransactionInterface;
use App\Infra\Common\Http\Http;

class GenericAuthorizationTransaction extends Http implements AuthorizationTransactionInterface
{

    public function authorize(): bool
    {
        $response =  json_decode($this->get('https://run.mocky.io/v3/8fafdd68-a090-496f-8c9a-3442cf30dae6'), true);
        if($response['message'] == 'Autorizado')
            return true;

        return false;

    }
}
