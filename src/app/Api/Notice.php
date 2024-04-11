<?php

namespace App\Api;

use PhalApi\Api;

use App\Domain\Notice as NoticeDomain;

/**
 * 舰长接口
 */

class Notice extends Api {

    public function getRules() {
        return array(
            'getNotice' => array(
                'id' => array('name' => 'id', 'type' => 'int', 'min' => 1, 'require' => true, 'desc' => '公告ID'),
                'live_id' => array('name' => 'live_id', 'type' => 'int', 'require' => true, 'desc' => '直播场次ID')
            ),
            'setNotice' => array(
                'data' => array('name' => 'data', 'type' => 'array', 'format' => 'json', 'require' => true, 'desc' => '舰长数据'),
            ),
        );
    }

    /**
     * 获取舰长
     * @desc 获取舰长
     * @return int code 操作码，0表示成功
     * @return array data 舰长数据
     * @return string msg 提示信息
     */
    public function getNotice() {
        $id = $this->id;
        $live_id = $this->live_id;

        $domain = new NoticeDomain();
        $data = $domain->getNotice($id, $live_id);

        return $data;
    }

    /**
     * 上传舰长
     * @desc 上传舰长
     * @return int code 操作码，0表示成功
     * @return string msg 提示信息
     */
    public function setNotice() {
        $data = $this->data;

        for ($i = 0; $i < count($data); $i++) {
            if ($data[$i]['type'] == '舰长') {
                $data[$i]['type'] = 1;
            } else if ($data[$i]['type'] == '提督') {
                $data[$i]['type'] = 2;
            } else if ($data[$i]['type'] == '总督') {
                $data[$i]['type'] = 3;
            }
        }


        $domain = new NoticeDomain();
        $data = $domain->setNotice($data);

        return $data;
    }
}
