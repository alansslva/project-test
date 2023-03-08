<?php

namespace App\Domain\Application\Transaction\Creators;

use App\Domain\Application\Transaction\Entities\Interfaces\TransactionInterface;
use App\Domain\Application\Transaction\Entities\Transaction;
use App\Domain\Application\Transaction\Exceptions\NotAuthorizedException;
use App\Infra\Application\User\Repositories\Interfaces\UserRepositoryInterface;

class TransactionCreator
{
    protected int $userFromId;
    protected int $userToId;
    protected float $value;
    protected string $type;
    private UserRepositoryInterface $userRepository;

    public function __construct(
        $userFromId,
        $userToId,
        $value,
        $type,
        UserRepositoryInterface $userRepository
    )
    {
        $this->userFromId =  $userFromId;
        $this->userToId = $userToId;
        $this->value = (float) $value;
        $this->type = $type;
        $this->userRepository = $userRepository;
    }

    public function getEntity() : TransactionInterface
    {
       $transaction = new Transaction();
       $transaction->setUserFrom($this->userRepository->get($this->userFromId));

       if($transaction->getUserFrom()->getType() !== 'fisica')
           throw new NotAuthorizedException();

       $transaction->setUserTo($this->userRepository->get($this->userToId));
       $transaction->setValue($this->value);
       return $transaction;
    }
}
