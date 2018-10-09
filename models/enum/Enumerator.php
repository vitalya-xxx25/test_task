<?php

namespace app\models\enum;

class Enumerator
{
    protected static $items = [];

    /**
     * @return array
     */
    public static function getItems() {
        return static::$items;
    }

    /**
     * @return mixed|null
     */
    public static function getItemByKey($key) {
        return isset(static::$items[$key]) ? static::$items[$key] : null;
    }
}