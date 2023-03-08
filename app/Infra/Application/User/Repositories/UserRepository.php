<?php

namespace App\Infra\Application\User\Repositories;

use App\Infra\Application\User\DTO\Interfaces\UserDtoInterface;
use App\Infra\Application\User\Entities\Interfaces\UserInterface;
use App\Infra\Application\User\Entities\User;
use App\Infra\Application\User\Repositories\Interfaces\UserRepositoryInterface;
use Illuminate\Database\Eloquent\Model;

class UserRepository implements UserRepositoryInterface
{
    private Model $model;

    public function __construct(Model $model)
    {;
        $this->model = $model;
    }

    public function getAll(UserDtoInterface $userDto) : array
    {
        $users = $this->model->get();

        $response = [];
        foreach ($users as $user){
            $response[] = $userDto->getData($user);
        }

        return $response;
    }


    public function store(UserInterface $user) : void
    {
        $this->model->name = $user->name;
        $this->model->email = $user->email;
        $this->model->password = $user->password;
        $this->model->document = $user->document;
        $this->model->type = 'fisica';
        $this->model->value = $user->getValue();
        $this->model->save();
    }

    public function update(UserInterface $user) : void
    {
        $response = $this->model->where('id', $user->id)->first();
        $response->name = $user->name;
        $response->email = $user->email;
        $response->password = $user->password;
        $response->document = $user->document;
        $response->type = 'fisica';
        $response->value = $user->getValue();
        $response->save();
    }

    public function updateValue(UserInterface $user) : void
    {
        $response = $this->model->where('id', $user->id)->first();
        $response->value = $user->getValue();
        $response->save();
    }

    public function get(int $id): User
    {
        $response = $this->model->where('id', $id)->first();
        $user = new User();
        $user->setEmail($response->email);
        $user->setName($response->name);
        $user->setDocument($response->document);
        $user->setType($response->type);
        $user->setValue($response->value);
        $user->id = $response->id;

        return $user;
    }
}
