<?php

namespace App\Model;

use PhalApi\Model\NotORMModel as NotORM;

/**
 * 弹幕模型
 */

class Danmu extends NotORM {

    // 获取弹幕
    public function getDanmu($id, $page, $pageSize, $live_id) {
        // 添加分页
        $data = $this->getORM()
            ->where('room_id', $id)
            ->where('live_id', $live_id)
            ->limit($pageSize * ($page - 1), $pageSize)
            ->fetchAll();

        // 获取$data的总数
        $data['count'] = count($data);
        
        return $data;
    }

    // 上传弹幕

    public function addDanmu($data) {

        return $this->getORM()->insert_multi($data);

    }
}