<?php

namespace app\helpers;

use \yii\helpers\Url;

class UrlHelp
{
    /**
     * @param $path
     * @param array $additionalParameters
     * @param array $delParams
     * @return string
     */
    public static function generateUrl($path, $additionalParameters = [], $delParams = []) {
        $queryParams = \Yii::$app->request->get();

        if (!empty($delParams)) {
            foreach ($queryParams as $key => $val) {
                if (in_array($key, $delParams)) {
                    unset($queryParams[$key]);
                }
            }
        }

        $parameters = array_merge(
            [$path],
            $queryParams,
            $additionalParameters
        );

        return Url::to($parameters);
    }
}