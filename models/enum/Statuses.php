<?php
namespace app\models\enum;

class Statuses
{
    protected static $statuses = [
        0 => 'Pending',
        1 => 'In progress',
        2 => 'Completed',
        3 => 'Canceled',
        4 => 'Error',
    ];

    /**
     * @return array
     */
    public static function getStatus() {
        return self::$statuses;
    }

    /**
     * @return mixed|null
     */
    public static function getStatusName($key) {
        return isset(self::$statuses[$key]) ? self::$statuses[$key] : null;
    }
}