<?php

namespace App\Domain\Application\Transaction\Services;

use App\Domain\Application\Transaction\Entities\Interfaces\TransactionInterface;
use App\Domain\Application\Transaction\Exceptions\NotEnoughValueException;
use App\Domain\Application\Transaction\Repositories\Interfaces\TransactionRepositoryInterface;
use App\Domain\Application\Transaction\Services\Interfaces\MovementServiceInterface;
use App\Infra\Application\User\Repositories\Interfaces\UserRepositoryInterface;
use Illuminate\Support\Facades\DB;

class MovementService implements MovementServiceInterface
{
    private TransactionInterface $transaction;
    private TransactionRepositoryInterface $transactionRepository;
    private UserRepositoryInterface $userRepository;

    public function __construct(
        TransactionInterface $transaction,
        TransactionRepositoryInterface $transactionRepository,
        UserRepositoryInterface $userRepository
    )
    {
        $this->transaction = $transaction;
        $this->transactionRepository = $transactionRepository;
        $this->userRepository = $userRepository;
    }

    private function checarSaldo(TransactionInterface $transaction)
    {
        if($transaction->getValue() > $transaction->getUserFrom()->getValue())
            throw new NotEnoughValueException();
    }

    public function execute()
    {

        $this->checarSaldo($this->transaction);


        $this->transaction->getUserFrom()->setValue( $this->transaction->getUserFrom()->getValue() - $this->transaction->getValue() );
        $this->transaction->getUserTo()->setValue( $this->transaction->getUserTo()->getValue() + (float) $this->transaction->getValue() );


        DB::transaction(function (){
            $this->userRepository->updateValue($this->transaction->getUserFrom());
            $this->userRepository->updateValue($this->transaction->getUserTo());
            $this->transactionRepository->store($this->transaction);
        });


    }
}
