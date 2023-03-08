<?php

namespace Tests\Unit;

use App\Infra\Application\User\Entities\User;
use App\Infra\Application\User\Repositories\UserRepository;
use PHPUnit\Framework\TestCase;

class UsertTest extends TestCase
{
    public function testCriacaoDeUsuario()
    {
        $user = new User();
        $user->setName('Alan');

        $this->assertEquals('Alan', $user->getName());
    }

    public function testeInsersaoDeUsuarioBanco()
    {
        $user = new User();
        $user->setName('Alan');
        $user->setDocument('222');
        $user->setValue(222);
        $user->setEmail('alan@alan.com');
        $user->setPassword('alan@alan.com');
        $user->setType('fisica');

        $stub = $this->getMockBuilder(UserRepository::class)
            ->disableOriginalConstructor()
            ->disableOriginalClone()
            ->disableArgumentCloning()
            ->disallowMockingUnknownTypes()
            ->getMock();

        $stub->method('store');
        $stub->store($user);
        $this->assertTrue(true);

    }

}
