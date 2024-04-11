<?php

namespace App\Domain;

use App\Model\Combosend as CombosendModel;

class Combosend
{
    public function getCombosend($id, $live_id)
    {
        $combosendModel = new CombosendModel();
        $data = $combosendModel->getCombosend($id, $live_id);
        return $data;
    }

    public function setCombosend($data)
    {
        $combosendModel = new CombosendModel();

        return $combosendModel->setCombosend($data);
    }
}