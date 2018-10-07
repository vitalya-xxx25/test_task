<?php

namespace app\models\ar;

use yii\db\ActiveRecord;
use app\models\ar\Services;
use yii\db\Expression;

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
            ->alias('totalOrdersItems')
            ->select([
                'totalOrdersItems.id',
                'totalOrdersItems.name',
                'totalOrders' => new Expression('(select count(id) from '.Orders::tableName().' where service_id = totalOrdersItems.id group by service_id)')
            ])->asArray();
    }
}