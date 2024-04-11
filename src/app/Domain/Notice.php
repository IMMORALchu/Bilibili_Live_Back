<?php
namespace App\Domain;

use App\Model\Notice as NoticeModel;

class Notice {
    public function getNotice($id, $live_id) {
        $noticeModel = new NoticeModel();
        $data = $noticeModel->getNotice($id, $live_id);
        return $data;
    }

    public function setNotice($data) {
        $noticeModel = new NoticeModel();

        return $noticeModel->setNotice($data);
    }

}