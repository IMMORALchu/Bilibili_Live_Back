<?php
namespace App\Domain;

use App\Model\Superchat as SuperchatModel;

class Superchat {
    public function getSuperchat($id, $live_id) {
        $superchatModel = new SuperchatModel();
        $data = $superchatModel->getSuperchat($id, $live_id);
        return $data;
    }

    public function setSuperchat($data) {
        $superchatModel = new SuperchatModel();

        return $superchatModel->setSuperchat($data);
    }

}