<?php

namespace app\models\ar;

use yii\db\ActiveRecord;
use app\models\ar\Services;

class Orders extends ActiveRecord
{
    public static function primaryKey() {
        return ['id'];
    }

    public static function tableName() {
        return 'orders';
    }

    public function getServices() {
        return $this->hasOne(Services::className(), ['id' => 'service_id'])
            ->alias('services');
    }
}