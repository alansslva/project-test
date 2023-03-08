<?php

namespace App\Infra\Application\User\Services;

use App\Infra\Application\User\Entities\Interfaces\UserInterface;
use App\Infra\Application\User\Repositories\Interfaces\UserRepositoryInterface;
use App\Infra\Application\User\Repositories\UserRepository;
use App\Infra\Application\User\Services\Interfaces\CreateUserServiceInterface;
use Illuminate\Database\Eloquent\Model;

class CreateUserService implements CreateUserServiceInterface
{

    private UserInterface $user;
    private UserRepositoryInterface $userRepository;
    private Model $userModel;

    public function __construct(
       UserInterface $user,
       UserRepositoryInterface $userRepository,
       Model $userModel
   )
   {
       $this->user = $user;
       $this->userRepository = $userRepository;
       $this->userModel = $userModel;
   }

    public function execute()
    {

        $this->userRepository->store($this->user);
    }
}
