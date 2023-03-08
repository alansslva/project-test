<?php

namespace App\Infra\Application\User\Entities\Interfaces;

interface UserInterface
{
    public function getName() : string;
    public function getEmail() : string;
    public function getType() : string;
    public function getValue() : float;
    public function setName(string $name) : void;
    public function setEmail(string $email) : void;
    public function setType(string $type) : void;
    public function setValue(float $type) : void;
}
