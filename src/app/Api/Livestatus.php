<?php

namespace App\Api;

use PhalApi\Api;

use function PHPSTORM_META\type;

/**
 * 批量获取直播间信息接口
 */

class Livestatus extends Api
{

    public function getRules()
    {
        return array(
            'getLivestatus' => array(
                'roomid' => array('name' => 'roomid', 'type' => 'string', 'require' => true, 'desc' => '请求地址列表'),
            ),
        );
    }

    public function getLivestatus()
    {
        $roomidList = $this->roomid;
        $roomidList = explode(',', $roomidList);
        // 使用curl_multi
        $mh = curl_multi_init();
        $ch = array();
        $result = array();
        foreach ($roomidList as $roomid) {
            $url = "https://api.live.bilibili.com/xlive/web-room/v1/index/getRoomBaseInfo?room_ids=" . $roomid . "&req_biz=video";
            $ch[$roomid] = curl_init();
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
        }
        curl_multi_close($mh);
        return $result;
    }
}
