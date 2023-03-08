<?php

namespace App\Infra\Application\User\Entities;

use App\Infra\Application\User\Entities\Interfaces\UserInterface;

class User implements UserInterface
{
    public int $id;
    public string $name;
    public string $document;
    public string $type;
    public string $email;
    public string $password;
    public string $value;
    /**
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * @param string $document
     */
    public function setDocument(string $document): void
    {
        $this->document = $document;
    }

    /**
     * @param string $email
     */
    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    /**
     * @param string $password
     */
    public function setPassword(string $password): void
    {

        $this->password = base64_encode($password);
    }

    /**
     * @param bool $type
     */
    public function setType(string $type): void
    {
        $this->type = $type;
    }


    public function getName(): string
    {
       return $this->name;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getType(): string
    {
       return $this->type;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getValue(): float
    {
        return $this->value;
    }

    /**
     * @param string $value
     */
    public function setValue(float $value): void
    {
        $this->value = $value;
    }


}
