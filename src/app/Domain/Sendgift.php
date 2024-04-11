<?php

namespace App\Domain;

use App\Model\Sendgift as SendgiftModel;

class Sendgift
{
    public function getSendgift($id, $live_id)
    {
        $sendgiftModel = new SendgiftModel();
        $data = $sendgiftModel->getSendgift($id, $live_id);
        return $data;
    }

    public function setSendgift($data)
    {
        $sendgiftModel = new SendgiftModel();

        return $sendgiftModel->setSendgift($data);
    }
}