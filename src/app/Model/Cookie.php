<?php

namespace App\Model;

use PhalApi\Model\NotORMModel as NotORM;

class Cookie extends NotORM
{
    public function getCookie()
    {
        $data = $this->getORM()
            ->fetchAll();

        return $data;
    }
}