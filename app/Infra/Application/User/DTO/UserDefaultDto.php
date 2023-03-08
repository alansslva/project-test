<?php

namespace App\Infra\Application\User\DTO;

use App\Infra\Application\User\DTO\Interfaces\UserDtoInterface;
use Illuminate\Database\Eloquent\Model;

class UserDefaultDto implements UserDtoInterface
{
    public function getData(Model $user)
    {
        return [
            'id' => $user->id,
            'name' => $user->name,
            'email' => $user->email,
            'value' => $user->value,
        ];
    }
}
