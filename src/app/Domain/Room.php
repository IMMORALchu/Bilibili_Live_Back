<?php

namespace App\Domain;

use App\Model\Room as RoomModel;

class Room
{

    public function getRoom()
    {
        $roomModel = new RoomModel();
        $data = $roomModel->getRoom();
        return $data;
    }

    public function setRoom($room_id, $create_time)
    {
        $roomModel = new RoomModel();

        return $roomModel->setRoom($room_id, $create_time);
    }
}