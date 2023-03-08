<?php

namespace App\Domain\Application\Transaction\Entities;

use App\Domain\Application\Transaction\Entities\Interfaces\TransactionInterface;
use App\Infra\Application\User\Entities\Interfaces\UserInterface;

class Transaction implements TransactionInterface
{
    protected UserInterface $userFrom;
    protected UserInterface $userTo;
    protected string $type;
    protected string $value;
    protected bool $status;

    /**
     * @return UserInterface
     */
    public function getUserFrom(): UserInterface
    {
        return $this->userFrom;
    }

    /**
     * @param UserInterface $userFrom
     */
    public function setUserFrom(UserInterface $userFrom): void
    {
        $this->userFrom = $userFrom;
    }

    /**
     * @return UserInterface
     */
    public function getUserTo(): UserInterface
    {
        return $this->userTo;
    }

    /**
     * @param UserInterface $userTo
     */
    public function setUserTo(UserInterface $userTo): void
    {
        $this->userTo = $userTo;
    }

    /**
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * @param string $type
     */
    public function setType(string $type): void
    {
        $this->type = $type;
    }

    /**
     * @return float
     */
    public function getValue(): string
    {
        return $this->value;
    }

    /**
     * @param float $value
     */
    public function setValue(float $value): void
    {
        $this->value = $value;
    }

    /**
     * @return bool
     */
    public function isStatus(): bool
    {
        return $this->status;
    }

    /**
     * @param bool $status
     */
    public function setStatus(bool $status): void
    {
        $this->status = $status;
    }


}
