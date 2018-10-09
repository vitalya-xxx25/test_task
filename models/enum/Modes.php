<?php
namespace app\models\enum;

use app\models\enum\Enumerator;

class Modes extends Enumerator
{
    protected static $items = [
        0 => 'All',
        1 => 'Manual',
        2 => 'Auto',
    ];
}