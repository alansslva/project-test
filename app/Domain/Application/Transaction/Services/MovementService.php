<?php

namespace App\Domain\Application\Transaction\Services;

use App\Domain\Application\Transaction\Entities\Interfaces\TransactionInterface;
use App\Domain\Application\Transaction\Exceptions\NotAuthorizedException;
use App\Domain\Application\Transaction\Exceptions\NotEnoughValueException;
use App\Domain\Application\Transaction\Repositories\Interfaces\TransactionRepositoryInterface;
use App\Domain\Application\Transaction\Services\Interfaces\MovementServiceInterface;
use App\Infra\Application\User\Repositories\Interfaces\UserRepositoryInterface;
use App\Infra\Common\Adapters\AdapterHandlerInterface;
use App\Infra\Common\AuthorizationTransaction\Interfaces\AuthorizationTransactionInterface;
use App\Infra\Common\Mail\Interfaces\SenderInterface;
use Illuminate\Support\Facades\DB;

class MovementService implements MovementServiceInterface
{
    private TransactionInterface $transaction;
    private TransactionRepositoryInterface $transactionRepository;
    private UserRepositoryInterface $userRepository;
    private SenderInterface $mailSender;
    private AuthorizationTransactionInterface $authorizationTransaction;
    private AdapterHandlerInterface $adapterHandlerEmail;
    private AdapterHandlerInterface $adapterHandlerAuthorization;

    public function __construct(
        TransactionInterface $transaction,
        TransactionRepositoryInterface $transactionRepository,
        UserRepositoryInterface $userRepository,
        AdapterHandlerInterface $adapterHandlerEmail,
        AdapterHandlerInterface $adapterHandlerAuthorization
    )
    {
        $this->transaction = $transaction;
        $this->transactionRepository = $transactionRepository;
        $this->userRepository = $userRepository;
        $this->adapterHandlerEmail = $adapterHandlerEmail;
        $this->adapterHandlerAuthorization = $adapterHandlerAuthorization;
    }

    private function checarSaldo(TransactionInterface $transaction)
    {
        if($transaction->getValue() > $transaction->getUserFrom()->getValue())
            throw new NotEnoughValueException();
    }

    private function checkAuthorization()
    {
        if(!$this->adapterHandlerAuthorization->getAdapter()->authorize())
            throw new NotAuthorizedException();
    }

    public function execute()
    {

        $this->checarSaldo($this->transaction);
        $this->checkAuthorization();


        $this->transaction->getUserFrom()->setValue( $this->transaction->getUserFrom()->getValue() - $this->transaction->getValue() );
        $this->transaction->getUserTo()->setValue( $this->transaction->getUserTo()->getValue() + (float) $this->transaction->getValue() );


        DB::transaction(function (){
            $this->userRepository->updateValue($this->transaction->getUserFrom());
            $this->userRepository->updateValue($this->transaction->getUserTo());
            $this->transactionRepository->store($this->transaction);
        });


    }
}
