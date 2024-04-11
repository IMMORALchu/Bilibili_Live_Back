<?php

namespace App\Model;

use PhalApi\Model\NotORMModel as NotORM;

class Linecount extends NotORM
{

    // 只获取7天内的
    public function getLinecount($id, $live_id)
    {
        $data = $this->getORM()
            ->where('id', $id)
            ->where('live_id', $live_id)
            ->where('create_time > ?', date('Y-m-d H:i:s', strtotime('-7 day')))
            ->fetchAll();

        $data['count'] = count($data);

        return $data;
    }

    public function setLinecount($data)
    {
        return $this->getORM()->insert_multi($data);
    }
}
