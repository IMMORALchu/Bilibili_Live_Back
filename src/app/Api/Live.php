<?php

namespace App\Api;

use PhalApi\Api;

use App\Domain\Live as LiveDomain;

/**
 * 直播场次接口
 */

class Live extends Api {

    public function getRules() {
        return array(
            'getLive' => array(
                'room_id' => array('name' => 'room_id', 'type' => 'int', 'min' => 1, 'require' => true, 'desc' => '房间ID'),
            ),
            'setLive' => array(
                'title' => array('name' => 'title', 'type' => 'string', 'require' => true, 'desc' => '直播标题'),
                'room_id' => array('name' => 'room_id', 'type' => 'int', 'require' => true, 'desc' => '房间ID'),
                'live_id' => array('name' => 'live_id', 'type' => 'int', 'require' => true, 'desc' => '直播场次ID'),
                'cover' => array('name' => 'cover', 'type' => 'string', 'require' => true, 'desc' => '封面'),
                'live_time' => array('name' => 'live_time', 'type' => 'string', 'require' => true, 'desc' => '直播开始时间'),
                'live_end' => array('name' => 'live_end', 'type' => 'string', 'require' => true, 'desc' => '直播结束时间'),
            ),
        );
    }

    /**
     * 获取直播场次
     * @desc 获取直播场次
     * @return int code 操作码，0表示成功
     * @return array data 直播场次数据
     * @return string msg 提示信息
     */
    public function getLive() {
        $room_id = $this->room_id;

        $domain = new LiveDomain();
        $data = $domain->getLive($room_id);

        return $data;
    }

    /**
     * 设置直播场次
     * @desc 设置直播场次
     * @return int code 操作码，0表示成功
     * @return string msg 提示信息
     */
    public function setLive() {
        $title = $this->title;
        $room_id = $this->room_id;
        $live_id = $this->live_id;
        $cover = $this->cover;
        $live_time = $this->live_time;
        $live_end = $this->live_end;

        $domain = new LiveDomain();

        return $domain->setLive($title, $room_id, $live_id, $cover, $live_time, $live_end);
    }
}