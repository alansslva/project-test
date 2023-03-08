<?php

namespace App\Application\Transaction\Http\Controllers;

use App\core\Http\Controllers\Controller;
use App\Domain\Application\Transaction\Creators\TransactionCreator;
use App\Domain\Application\Transaction\Models\TransactionModel;
use App\Domain\Application\Transaction\Repositories\TransactionRepository;
use App\Domain\Application\Transaction\Services\MovementService;
use App\Infra\Application\User\Models\User;
use App\Infra\Application\User\Repositories\UserRepository;
use App\Infra\Common\AuthorizationTransaction\AuthorizationAdapter;
use App\Infra\Common\AuthorizationTransaction\GenericAuthorizationTransaction;
use App\Infra\Common\Mail\EmailAdapter;
use App\Infra\Common\Mail\GenericSender;
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
            new UserRepository(new User()),
            new EmailAdapter(),
            new AuthorizationAdapter()
        ))->execute();
    }
}
