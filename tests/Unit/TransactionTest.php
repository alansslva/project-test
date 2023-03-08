<?php

namespace Tests\Unit;

use App\Domain\Application\Transaction\Entities\Transaction;
use App\Domain\Application\Transaction\Models\TransactionModel;
use App\Domain\Application\Transaction\Repositories\TransactionRepository;
use App\Domain\Application\Transaction\Services\MovementService;
use App\Infra\Application\User\Entities\User;
use App\Infra\Application\User\Repositories\UserRepository;
use App\Infra\Common\AuthorizationTransaction\AuthorizationAdapter;
use App\Infra\Common\Mail\EmailAdapter;
use Mockery\Mock;
use Tests\TestCase;

class TransactionTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function testeTransaction(): void
    {
        $user = new User();
        $user->id = 1;
        $user->setName('John Doe');
        $user->setEmail('john@john.com');
        $user->setDocument('1');
        $user->setValue(500);
        $user->setPassword('1234');

        $user2 = new User();
        $user2->id = 2;
        $user2->setName('John 2');
        $user2->setEmail('john@john2.com');
        $user2->setDocument('2');
        $user2->setValue(500);
        $user2->setPassword('1234');

        $transaction = new Transaction();
        $transaction->setUserFrom($user);
        $transaction->setUserTo($user2);
        $transaction->setValue(25);
        $transaction->setType('C');

        $stub = $this->createStub(MovementService::class);

        $stub = new $stub(
            $transaction,
            new TransactionRepository(new TransactionModel()),
            new UserRepository(new \App\Infra\Application\User\Models\User()),
            new EmailAdapter(),
            new AuthorizationAdapter()
        );

        $stub->method('execute')
            ->willReturn(true);

        $stub->execute();

        $this->assertEquals(475.00, $transaction->getUserFrom()->getValue());
    }
}
