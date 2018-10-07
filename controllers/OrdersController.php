<?php

namespace app\controllers;

use app\models\enum\Modes;
use app\models\OrdersModel;
use yii\data\ActiveDataProvider;
use yii\db\Expression;
use yii\web\Controller;

class OrdersController extends Controller
{
    public $layout = 'test';

    /**
     * @return string
     */
    public function actionIndex()
    {
        $ordersQuery = OrdersModel::find()
            ->alias('self')
            ->with([
                'services' => function ($query) {
                    $query->alias('t')
                        ->select([
                        't.id',
                        't.name',
                        'totalOrders' => new Expression('(select count(id) from orders where service_id = t.id group by service_id)')
                    ])->asArray();
                }
            ]);

        $provider = new ActiveDataProvider([
            'query' => $ordersQuery,
            'pagination' => [
                'pageSize' => 100,
            ],
            'sort' => [
                'defaultOrder' => [
                    'id' => SORT_DESC,
                ]
            ],
        ]);

        $paginator = $provider->getPagination();
        $orders = $provider->getModels();

        $page = (int) \Yii::$app->request->get('page');
        $pageFrom = (1 < $page) ? $paginator->getPageSize() * $page : 1;
        $pageTo = $pageFrom + count($orders);

        return $this->render('index', [
            'orders' => $orders,
            'modes' => Modes::getModes(),
            'paginator' => $paginator,
            'totalRows' => $provider->getTotalCount(),
            'pageFrom' => $pageFrom,
            'pageTo' => $pageTo,
        ]);
    }
}