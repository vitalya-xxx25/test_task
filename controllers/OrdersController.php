<?php

namespace app\controllers;

use app\models\ar\Services;
use app\models\enum\Modes;
use app\models\enum\SearchTypes;
use app\models\enum\Statuses;
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
        $request = \Yii::$app->request;
        $filters = [
            'service' => (int) $request->get('service'),
            'status' => (int) $request->get('status'),
            'mode' => (int) $request->get('mode'),
            'search' => $request->get('search'),
            'searchType' => (int) $request->get('search-type')
        ];

        $ordersQuery = OrdersModel::find()
            ->alias('self')
            ->with('services');

        $this->_applyFilter($ordersQuery, $filters);

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
        $services = Services::find()
            ->alias('t')
            ->select([
                't.id',
                't.name',
                'totalOrders' => new Expression('(select count(id) from '.OrdersModel::tableName().' where service_id = t.id group by service_id)')
            ])
            ->asArray()
            ->all();

        // Страницы с - по
        $page = (int) $request->get('page');
        $pageSize = $paginator->getPageSize();
        $pageFrom = (1 < $page) ? ($pageSize * $page - ($pageSize - 1)) : 1;
        $pageTo = $pageFrom + (count($orders) - 1);

        return $this->render('index', [
            'orders' => $orders,
            'modes' => Modes::getItems(),
            'statuses' => Statuses::getItems(),
            'paginator' => $paginator,
            'totalRows' => $provider->getTotalCount(),
            'pageFrom' => $pageFrom,
            'pageTo' => $pageTo,
            'services' => $services,
            'filters' => $filters,
            'searchTypes' => SearchTypes::getItems()
        ]);
    }

    /**
     * @param $query
     * @param $filter
     */
    private function _applyFilter($query, $filter) {
        if (!empty($filter['service'])) {
            $query->andWhere(['self.service_id' => $filter['service']]);
        }

        if (!empty($filter['status'])) {
            $query->andWhere(['self.status' => $filter['status']]);
        }

        if (!empty($filter['mode'])) {
            $query->andWhere(['self.mode' => $filter['mode']]);
        }

        if (
            !empty($filter['search'])
            && (!empty($filter['searchType']) && in_array($filter['searchType'], [1, 2, 3]))
        ) {
            switch ($filter['searchType']) {
                case 1 :
                    $query->andWhere(['LIKE', 'self.id', $filter['search']]);
                    break;
                case 2 :
                    $query->andWhere(['LIKE', 'self.link', $filter['search']]);
                    break;
                case 3 :
                    $query->andWhere(['LIKE', 'self.user', $filter['search']]);
                    break;
            }
        }
    }
}