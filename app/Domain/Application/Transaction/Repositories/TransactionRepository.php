<?php

namespace App\Domain\Application\Transaction\Repositories;

use App\Domain\Application\Transaction\Entities\Interfaces\TransactionInterface;
use App\Domain\Application\Transaction\Models\TransactionModel;
use App\Domain\Application\Transaction\Repositories\Interfaces\TransactionRepositoryInterface;

class TransactionRepository implements TransactionRepositoryInterface
{
    private TransactionModel $transactionModel;

    public function __construct(TransactionModel $transactionModel)
    {
        $this->transactionModel = $transactionModel;
    }

    public function store(TransactionInterface $transaction)
    {
        $transactionStore = new TransactionModel();
        $transactionStore->user_from_id = $transaction->getUserFrom()->id;
        $transactionStore->user_to_id = $transaction->getUserTo()->id;
        $transactionStore->value = $transaction->getValue();
        $transactionStore->type = 'C';
        $transactionStore->status = 1;
        $transactionStore->save();
    }
}
