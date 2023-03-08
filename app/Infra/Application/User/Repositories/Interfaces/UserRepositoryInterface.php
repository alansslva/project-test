<?php

namespace App\Infra\Application\User\Repositories\Interfaces;

use App\Infra\Application\User\DTO\Interfaces\UserDtoInterface;
use App\Infra\Application\User\Entities\Interfaces\UserInterface;
use App\Infra\Application\User\Entities\User;
use Illuminate\Database\Eloquent\Model;

interface UserRepositoryInterface
{
    public function __construct(Model $model);

    public function getAll(UserDtoInterface $userDto) : array;
    public function get(int $id) : User;
    public function store(UserInterface $user);

    public function update(UserInterface $user) : void;
    public function updateValue(UserInterface $user) : void;
}
