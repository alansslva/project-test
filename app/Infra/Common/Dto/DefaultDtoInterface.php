<?php

namespace App\Infra\Common\Dto;

use Illuminate\Database\Eloquent\Model;

interface DefaultDtoInterface
{
    public function setData(Model $model) : void;

    public function getData() : array;
}
