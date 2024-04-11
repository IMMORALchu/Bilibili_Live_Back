<?php

namespace App\Api;

use PhalApi\Api;

use App\Domain\Linecount as LinecountDomain;

/**
 * 在线人数接口
 */

class Linecount extends Api {

    public function getRules() {
        return array(
            'getLinecount' => array(
                'id' => array('name' => 'id', 'type' => 'int', 'min' => 1, 'require' => true, 'desc' => '房间ID'),
                'live_id' => array('name' => 'live_id', 'type' => 'int', 'require' => true, 'desc' => '直播场次ID')
            ),
            'setLinecount' => array(
                'data' => array('name' => 'data', 'type' => 'array', 'format' => 'json', 'require' => true, 'desc' => '在线人数数据'),
            ),
        );
    }

    /**
     * 获取在线人数
     * @desc 获取在线人数
     * @return int code 操作码，0表示成功
     * @return array data 在线人数数据
     * @return string msg 提示信息
     */
    public function getLinecount() {
        $id = $this->id;
        $live_id = $this->live_id;


        $domain = new LinecountDomain();
        $data = $domain->getLinecount($id, $live_id);

        return $data;
    }

    /**
     * 设置在线人数
     * @desc 设置在线人数
     * @return int code 操作码，0表示成功
     * @return string msg 提示信息
     */
    public function setLinecount() {
        $data = $this->data;

        $domain = new LinecountDomain();
        $data = $domain->setLinecount($data);

        return $data;
    }

}