<?php

namespace App\Model;

use PhalApi\Model\NotORMModel as NotORM;

class Live extends NotORM
{

    public function getLive($room_id)
    {
        $data = $this->getORM()
            ->where('room_id', $room_id)
            ->fetchAll();

        return $data;
    }

    public function setLive($title, $room_id, $live_id, $cover, $live_time, $live_end)
    {
        $data = array(
            'title' => $title,
            'room_id' => $room_id,
            'live_id' => $live_id,
            'cover' => $cover,
            'live_time' => $live_time,
            'live_end' => $live_end
        );

        // 如果live_id存在，则更新

        $row = $this->getORM()
            ->where('live_id', $live_id)
            ->fetch();

        if ($row) {
            $result = $this->getORM()
                ->where('live_id', $live_id)
                ->update($data);
        } else {
            $result = $this->getORM()
                ->insert($data);
        }
    }
}