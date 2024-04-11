<?php
namespace App\Domain;

use App\Model\Linecount as LinecountModel;

class Linecount {
    public function getLinecount($id, $live_id) {
        $linecountModel = new LinecountModel();
        $data = $linecountModel->getLinecount($id, $live_id);
        return $data;
    }

    public function setLinecount($data) {
        $linecountModel = new LinecountModel();

        return $linecountModel->setLinecount($data);
    }

}