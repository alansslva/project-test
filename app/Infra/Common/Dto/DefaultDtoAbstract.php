<?php

namespace App\Infra\Common\Dto;

use Illuminate\Database\Eloquent\Model;

abstract class DefaultDtoAbstract implements DefaultDtoInterface
{
    protected array $data;

    public function setData(Model $model) : void
    {
        $this->data = $model->toArray();
    }

    public function getData() : array
    {
        return $this->data;
    }

}
