<?php

namespace App\Api;

use PhalApi\Api;

use App\Domain\Sendgift as Domain_Sendgift;

/**
 * 礼物接口
 */

class Sendgift extends Api
{

    public function getRules()
    {
        return array(
            'getSendgift' => array(
                'id' => array('name' => 'id', 'type' => 'int', 'min' => 1, 'require' => true, 'desc' => '房间 ID'),
                'live_id' => array('name' => 'live_id', 'type' => 'int', 'require' => true, 'desc' => '直播场次ID')
            ),
            'setSendgift' => array(
                'data' => array('name' => 'data', 'type' => 'array', 'format' => 'json', 'require' => true, 'desc' => '礼物数据'),
            ),
        );
    }

    /**
     * 获取礼物
     * @desc 获取礼物
     * @return int code 操作码，0表示成功
     * @return array data 礼物数据
     * @return string msg 提示信息
     */

    public function getSendgift()
    {
        $id = $this->id;
        $live_id = $this->live_id;

        $domain = new Domain_Sendgift();
        $data = $domain->getSendgift($id, $live_id);

        return $data;
    }

    /**
     * 上传礼物
     * @desc 上传礼物
     * @return int code 操作码，0表示成功
     * @return string msg 提示信息
     */

    public function setSendgift()
    {
        $data = $this->data;
        $domain = new Domain_Sendgift();
        $data = $domain->setSendgift($data);

        return $data;
    }
}