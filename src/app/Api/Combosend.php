<?php

namespace App\Api;

use PhalApi\Api;

use App\Domain\Combosend as Domain_Combosend;

/**
 * 组合礼物接口
 */

class Combosend extends Api
{
    
        public function getRules()
        {
            return array(
                'getCombosend' => array(
                    'id' => array('name' => 'id', 'type' => 'int', 'min' => 1, 'require' => true, 'desc' => '房间 ID'),
                    'live_id' => array('name' => 'live_id', 'type' => 'int', 'require' => true, 'desc' => '直播场次ID')
                ),
                'setCombosend' => array(
                    'data' => array('name' => 'data', 'type' => 'array', 'format' => 'json', 'require' => true, 'desc' => '组合礼物数据')
                ),
            );
        }
    
        /**
        * 获取组合礼物
        * @desc 获取组合礼物
        * @return int code 操作码，0表示成功
        * @return array data 组合礼物数据
        * @return string msg 提示信息
        */

        public function getCombosend()
        {
            $id = $this->id;
            $live_id = $this->live_id;


            $domain = new Domain_Combosend();
            $data = $domain->getCombosend($id, $live_id);

            return $data;
        }

        /**
         * 上传组合礼物
         * @desc 上传组合礼物
         * @return int code 操作码，0表示成功
         * @return string msg 提示信息
         */

        public function setCombosend()
        {
            $data = $this->data;

            $domain = new Domain_Combosend();

            return $domain->setCombosend($data);
        }
}
