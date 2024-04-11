<?php
namespace App\Domain;

use App\Model\Danmu as DanmuModel;

class Danmu {
    public function getDanmu($id, $page, $pageSize, $live_id) {
        $danmuModel = new DanmuModel();
        $data = $danmuModel->getDanmu($id, $page, $pageSize, $live_id);
        return $data;
    }

    public function addDanmu($data) {
        $danmuModel = new DanmuModel();

        return $danmuModel->addDanmu($data);
    }

}