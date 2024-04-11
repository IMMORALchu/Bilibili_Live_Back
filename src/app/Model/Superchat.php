<?php

namespace App\Model;

use PhalApi\Model\NotORMModel as NotORM;

class Superchat extends NotORM {

    public function getSuperchat($id, $live_id) {
        $data = $this->getORM()
            ->where('id', $id)
            ->where('live_id', $live_id)
            ->fetchAll();

        $data['count'] = count($data);

        return $data;
    }

    // content 内容
    // price 价格
    // send_user 发送者
    // create_time 发送时间
    // room_id 直播间ID
    // up_id UP主ID
    // up_name UP主名字

    public function setSuperchat($data) {
        return $this->getORM()->insert_multi($data);
    }

}