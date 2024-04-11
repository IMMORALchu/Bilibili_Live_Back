<?php

namespace App\Model;

use PhalApi\Model\NotORMModel as NotORM;

use App\Model\Cookie as CookieModel;

class Room extends NotORM
{

    public function getRoom()
    {
        $data = $this->getORM()
            ->fetchAll();


        $cookie = new CookieModel();
        $cookieData = $cookie->getCookie();

        // 所有的room_id整理出来,拼接成字符串如"1,2,3"
        $room_id = '';
        foreach ($data as $key => $value) {
            $room_id .= $value['room_id'] . ',';
        }
        $roomidList = rtrim($room_id, ',');

        $roomidList = explode(',', $roomidList);
        // 使用curl_multi
        $mh = curl_multi_init();
        $ch = array();
        $result = array();
        
        // 设置 HTTP 头部信息，包括 cookie
        $hearder = array(
            'Cookie: ' . $cookieData,
        );
        foreach ($roomidList as $roomid) {
            $url = "https://api.live.bilibili.com/xlive/web-room/v1/index/getRoomBaseInfo?room_ids=" . $roomid . "&req_biz=video";
            $ch[$roomid] = curl_init();
            $ch2[$roomid] = curl_init();
            // 设置curl选项
            curl_setopt($ch[$roomid], CURLOPT_URL, $url);
            curl_setopt($ch[$roomid], CURLOPT_SSL_VERIFYPEER, 0);
            curl_setopt($ch[$roomid], CURLOPT_SSL_VERIFYHOST, 0);
            curl_setopt($ch[$roomid], CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']);
            curl_setopt($ch[$roomid], CURLOPT_FOLLOWLOCATION, 1);
            curl_setopt($ch[$roomid], CURLOPT_AUTOREFERER, 1);
            curl_setopt($ch[$roomid], CURLOPT_TIMEOUT, 30);
            curl_setopt($ch[$roomid], CURLOPT_HEADER, 0);
            curl_setopt($ch[$roomid], CURLOPT_RETURNTRANSFER, 1);

            curl_multi_add_handle($mh, $ch[$roomid]);
            curl_multi_add_handle($mh, $ch2[$roomid]);
        }
        $active = null;
        do {
            $mrc = curl_multi_exec($mh, $active);
        } while ($mrc == CURLM_CALL_MULTI_PERFORM);
        while ($active && $mrc == CURLM_OK) {
            if (curl_multi_select($mh) != -1) {
                do {
                    $mrc = curl_multi_exec($mh, $active);
                } while ($mrc == CURLM_CALL_MULTI_PERFORM);
            }
        }

        foreach ($roomidList as $roomid) {
            $result[$roomid] = json_decode(curl_multi_getcontent($ch[$roomid]), true)['data']['by_room_ids'][$roomid];
            curl_multi_remove_handle($mh, $ch[$roomid]);
            curl_multi_remove_handle($mh, $ch2[$roomid]);
        }
        curl_multi_close($mh);

        // 在result中找到对应的data中的room_id的数据,添加到data中
        foreach ($data as $key => $value) {
            $room_id = $value['room_id'];
            $data[$key]['room_info'] = $result[$room_id];
        }



        return $data;
    }

    public function setRoom($room_id, $create_time)
    {
        $data = array(
            'room_id' => $room_id,
            'create_time' => $create_time,
        );

        // 请求https://api.live.bilibili.com/room/v1/Room/room_init?id= 获取真实room_id
        $url = "https://api.live.bilibili.com/room/v1/Room/room_init?id=" . $room_id;
        $ch = curl_init();
        // 设置curl选项
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($ch, CURLOPT_AUTOREFERER, 1);
        curl_setopt($ch, CURLOPT_TIMEOUT, 30);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $data['room_id'] = json_decode(curl_exec($ch), true)['data']['room_id'];
        curl_close($ch);

        // 如果room_id存在，则返回错误

        $row = $this->getORM()
            ->where('room_id', $data['room_id'])
            ->fetch();

        if ($row) {
            return 'room_id已存在';
        } else {
            // 返回错误
            $result = $this->getORM()
                ->insert($data);
        }

        return $result;
    }
}
