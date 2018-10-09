<?php
namespace app\models\enum;

use app\models\enum\Enumerator;

class Statuses extends Enumerator
{
    protected static $items = [
        0 => 'Pending',
        1 => 'In progress',
        2 => 'Completed',
        3 => 'Canceled',
        4 => 'Error',
    ];
}