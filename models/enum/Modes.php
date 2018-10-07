<?php
namespace app\models\enum;

class Modes
{
    protected static $modes = [
        0 => 'All',
        1 => 'Manual',
        2 => 'Auto',
    ];

    /**
     * @return array
     */
    public static function getModes() {
        return self::$modes;
    }

    /**
     * @return mixed|null
     */
    public static function getModeName($key) {
        return isset(self::$modes[$key]) ? self::$modes[$key] : null;
    }
}