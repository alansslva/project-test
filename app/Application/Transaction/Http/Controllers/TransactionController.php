<?php

namespace App\Application\Transaction\Http\Controllers;

use App\core\Http\Controllers\Controller;
use App\Domain\Application\Transaction\Creators\TransactionCreator;
use App\Domain\Application\Transaction\Models\TransactionModel;
use App\Domain\Application\Transaction\Repositories\TransactionRepository;
use App\Domain\Application\Transaction\Services\MovementService;
use App\Infra\Application\User\Models\User;
use App\Infra\Application\User\Repositories\UserRepository;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    public function store(Request $request)
    {
        $transaction = (new TransactionCreator(
            $request->payer,
            $request->payee,
            $request->value,
            'C',
            new UserRepository(new User())
        ))->getEntity();

        (new MovementService(
            $transaction,
            new TransactionRepository(new TransactionModel()),
            new UserRepository(new User())
        ))->execute();
    }
}
