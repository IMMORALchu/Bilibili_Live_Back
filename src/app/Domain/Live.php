<?php

namespace App\Domain;

use App\Model\Live as LiveModel;

class Live
{
    public function getLive($room_id)
    {
        $liveModel = new LiveModel();
        $data = $liveModel->getLive($room_id);
        return $data;
    }

    public function setLive($title, $room_id, $live_id, $cover, $live_time, $live_end)
    {
        $liveModel = new LiveModel();

        return $liveModel->setLive($title, $room_id, $live_id, $cover, $live_time, $live_end);
    }
}