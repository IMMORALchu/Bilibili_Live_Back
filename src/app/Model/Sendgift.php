<?php

namespace App\Model;

use PhalApi\Model\NotORMModel as NotORM;

class Sendgift extends NotORM
{

    public function getSendgift($id, $live_id)
    {
        $data = $this->getORM()
            ->where('room_id', $id)
            ->where('live_id', $live_id)
            ->fetchAll();

        // 如果$data里面的gift_id有重复的,则都删除,只保留一个
        $gift_id = array();
        foreach ($data as $key => $value) {
            // 保留第一个
            if (in_array($value['gift_id'], $gift_id)) {
                unset($data[$key]);
            } else {
                $gift_id[] = $value['gift_id'];
            }
            
        }

        // 根据$data里面的gift_id,用sql语句查询在combosend表中数据,如果有则替换,没有则不替换
        foreach ($data as $key => $value) {
            $sql = "SELECT * FROM combosend WHERE gift_id = '" . $value['gift_id'] . "'";
            $combo = $this->getORM()
                ->queryAll($sql);
            if ($combo) {
                $data[$key] = $combo[0];
            }
        }

        return $data;
    }

    // send_user 发送者
    // gift_name 礼物名字
    // gift_id 礼物ID
    // gift_num 礼物数量
    // gift_price 礼物价格
    // gift_type 礼物类型
    // create_time 发送时间
    // room_id 直播间ID
    // up_id UP主ID
    // up_name UP主名字

    public function setSendgift($data)
    {
        return $this->getORM()->insert_multi($data);
    }
}
