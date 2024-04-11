<?php

namespace App\Api;

use PhalApi\Api;

use App\Domain\Room as Domain_Room;

/**
 * 房间列表接口
 */

class Room extends Api
{
    
        public function getRules()
        {
            return array(
                'setRoom' => array(
                    'room_id' => array('name' => 'room_id', 'type' => 'int', 'require' => true, 'desc' => '房间ID'),
                    'create_time' => array('name' => 'create_time', 'type' => 'int', 'require' => true, 'desc' => '创建时间')
                ),
            );
        }
    
        /**
        * 获取房间列表
        * @desc 获取房间列表
        * @return int code 操作码，0表示成功
        * @return array data 房间列表数据
        * @return string msg 提示信息
        */

        public function getRoom()
        {

            $domain = new Domain_Room();
            $data = $domain->getRoom();

            return $data;
        }

        /**
        * 设置房间
        * @desc 设置房间
        * @return int code 操作码，0表示成功
        * @return string msg 提示信息
        */

        public function setRoom()
        {
            $room_id = $this->room_id;
            $create_time = $this->create_time;

            $domain = new Domain_Room();
            $data = $domain->setRoom($room_id, $create_time);

            return $data;
        }
}