<?php

namespace App\Infra\Application\User\DTO;

use App\Infra\Application\User\DTO\Interfaces\UserDtoInterface;
use Illuminate\Database\Eloquent\Model;

class UserDefaultDto implements UserDtoInterface
{
    public function getData(Model $user)
    {
        $transactionsIn = $user->transactionsIn->toArray();
        $transactionsOut = $user->transactionsOut->toArray();

        $data = [
            'id' => $user->id,
            'name' => $user->name,
            'email' => $user->email,
            'value' => $user->value,
            'transactions_in' => [],
            'transactions_out' => [],
            'initial_value' => (float) $user->value - (float) $user->transactionsOut->sum('value') + (float) $user->transactionsOut->sum('value')
        ];

        foreach ($transactionsIn as $transaction){
            $data['transactions_in'][] = [
                'user_from' => $transaction['user_from_id'],
                'user_to' => $transaction['user_to_id'],
                'value' => $transaction['value'],
            ];
        }

        foreach ($transactionsOut as $transaction){
            $data['transactions_in'][] = [
                'user_from' => $transaction['user_from_id'],
                'user_to' => $transaction['user_to_id'],
                'value' => $transaction['value'],
            ];
        }

        return $data;
    }
}
