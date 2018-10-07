<?php

namespace app\models\ar;

use yii\db\ActiveRecord;
use app\models\ar\Orders;

class Services extends ActiveRecord
{
    public static function primaryKey() {
        return ['id'];
    }

    public static function tableName() {
        return 'services';
    }

    public function getOrders() {
        return $this->hasMany(Orders::className(), ['service_id' => 'id'])
            ->alias('orders');
    }
}