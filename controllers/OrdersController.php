<?php

namespace app\controllers;

use yii\web\Controller;

class OrdersController extends Controller
{
    public $layout = 'test';

    /**
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }
}