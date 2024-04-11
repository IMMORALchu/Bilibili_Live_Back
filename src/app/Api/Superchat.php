<?php

namespace App\Api;

use PhalApi\Api;

use App\Domain\Superchat as SuperchatDomain;

/**
 * SC接口
 */

class Superchat extends Api {

    public function getRules() {
        return array(
            'getSuperchat' => array(
                'id' => array('name' => 'id', 'type' => 'int', 'min' => 1, 'require' => true, 'desc' => 'SC ID'),
                'live_id' => array('name' => 'live_id', 'type' => 'int', 'require' => true, 'desc' => '直播场次ID')
            ),
            'setSuperchat' => array(
                'data' => array('name' => 'data', 'type' => 'array', 'format' => 'json', 'require' => true, 'desc' => 'SC数据'),
            ),
        );
    }

    /**
     * 获取SC
     * @desc 获取SC
     * @return int code 操作码，0表示成功
     * @return array data SC数据
     * @return string msg 提示信息
     */
    public function getSuperchat() {
        $id = $this->id;
        $live_id = $this->live_id;

        $domain = new SuperchatDomain();
        $data = $domain->getSuperchat($id, $live_id);

        return $data;
    }

    /**
     * 上传SC
     * @desc 上传SC
     * @return int code 操作码，0表示成功
     * @return string msg 提示信息
     */

    public function setSuperchat() {
        $data = $this->data;

        $domain = new SuperchatDomain();
        $data = $domain->setSuperchat($data);

        return $data;
    }
}