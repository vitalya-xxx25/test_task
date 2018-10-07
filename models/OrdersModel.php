<?php

namespace app\models;

use app\models\ar\Orders;
use app\models\enum\Statuses;
use app\models\enum\Modes;

class OrdersModel extends Orders
{
    /**
     * @return mixed|null
     */
    public function getStatusName() {
        return Statuses::getStatusName($this->status);
    }

    /**
     * @return mixed|null
     */
    public function getModeName() {
        return Modes::getModeName($this->mode);
    }

    /**
     * @return false|string
     */
    public function getDateCreate() {
        return date('Y-m-d', $this->created_at);
    }

    /**
     * @return false|string
     */
    public function getTimeCreate() {
        return date('H:i:s', $this->created_at);
    }
}