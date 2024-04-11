<?php

namespace App\Model;

use PhalApi\Model\NotORMModel as NotORM;

class Notice extends NotORM {

    public function getNotice($id, $live_id) {
        $data = $this->getORM()
            ->where('id', $id)
            ->where('live_id', $live_id)
            ->fetchAll();

        $data['count'] = count($data);

        return $data;
    }

    public function setNotice($data) {
        return $this->getORM()->insert_multi($data);
    }
}