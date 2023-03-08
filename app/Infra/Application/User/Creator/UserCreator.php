<?php

namespace App\Infra\Application\User\Creator;

use App\Infra\Application\User\Entities\Interfaces\UserInterface;

class UserCreator
{
    private UserInterface $user;

    public function __construct(UserInterface $user)
    {
        $this->user = $user;
    }

    public function setName(string $name) : static
    {
        $this->user->setName($name);
        return $this;
    }

    public function setDocument(string $document) : static
    {
        $this->user->setDocument($document);
        return $this;
    }

    public function setEmail(string $email) : static
    {
        $this->user->setEmail($email);
        return $this;
    }

    public function setPassword(string $password) : static
    {
        $this->user->setPassword($password);
        return $this;
    }
   public function setType(string $type) : static
    {
        $this->user->setType($type);
        return $this;
    }

    public function setValue($value) : static
    {
        $this->user->setValue($value);
        return $this;
    }

    public function getUser() : UserInterface
    {
        return $this->user;
    }


}
