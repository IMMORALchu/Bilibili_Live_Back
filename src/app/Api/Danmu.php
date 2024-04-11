<?php

namespace App\Api;

use PhalApi\Api;

use App\Domain\Danmu as DanmuDomain;

/**
 * 弹幕接口
 */

class Danmu extends Api {

    public function getRules() {
        return array(
            'getDanmu' => array(
                'id' => array('name' => 'id', 'type' => 'int', 'min' => 1, 'require' => true, 'desc' => 'UPID'),
                'live_id' => array('name' => 'live_id', 'type' => 'int', 'require' => true, 'desc' => '直播场次ID'),
                'page' => array('name' => 'page', 'type' => 'int', 'min' => 1, 'require' => false, 'desc' => '页码', 'default' => 1), // 默认值为1
                'pageSize' => array('name' => 'pageSize', 'type' => 'int', 'min' => 1, 'require' => false, 'desc' => '每页数量', 'default' => 10), // 默认值为10
            ),
            'addDanmu' => array(
                'data' => array('name' => 'data', 'type' => 'array', 'format' => 'json', 'require' => true, 'desc' => '弹幕数据'),
            ),
        );
    }

    /**
     * 获取弹幕
     * @desc 获取弹幕
     * @return int code 操作码，0表示成功
     * @return array data 弹幕数据
     * @return int count 弹幕总数
     * @return string msg 提示信息
     */
    public function getDanmu() {
        $id = $this->id;
        $live_id = $this->live_id;

        $domain = new DanmuDomain();
        $data = $domain->getDanmu($id, $this->page, $this->pageSize, $live_id);

        return $data;
    }

    /**
     * 上传弹幕
     * @desc 上传弹幕
     * @return int code 操作码，0表示成功
     * @return string msg 提示信息
     */
    public function addDanmu() {
        $data = $this->data;

        $domain = new DanmuDomain();
        $data = $domain->addDanmu($data);

        return $data;
    }
}
