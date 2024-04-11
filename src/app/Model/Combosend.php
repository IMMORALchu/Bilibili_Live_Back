<?php

namespace App\Model;

use PhalApi\Model\NotORMModel as NotORM;

class Combosend extends NotORM
{

    public function getCombosend($id, $live_id)
    {
        $data = $this->getORM()
            ->where('room_id', $id)
            ->where('live_id', $live_id)
            ->fetchAll();

        $data['count'] = count($data);

        return $data;

    }

    // send_user 发送者
    // gift_name 礼物名字
    // gift_id 礼物ID
    // gift_num 礼物总数量
    // gift_price 礼物总价格
    // gift_type 礼物类型
    // create_time 发送时间
    // room_id 直播间ID
    // up_id UP主ID
    // up_name UP主名字

    public function setCombosend($data)
    {
        return $this->getORM()->insert_multi($data);
    }
}