<?php
namespace app\models\enum;

class Statuses
{
    protected static $statuses = [
        0 => 'In work',
        1 => 'Pending',
        2 => 'Canceled',
        3 => 'Error',
        4 => 'Done',
    ];

    /**
     * @return mixed|null
     */
    public static function getStatusName($key) {
        return isset(self::$statuses[$key]) ? self::$statuses[$key] : null;
    }
}