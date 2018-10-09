<?php
namespace app\models\enum;

use app\models\enum\Enumerator;

class SearchTypes extends Enumerator
{
    protected static $items = [
        1 => 'Order ID',
        2 => 'Link',
        3 => 'Username',
    ];
}