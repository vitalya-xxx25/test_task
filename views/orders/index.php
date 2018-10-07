<?php
    use app\helpers\UrlHelp;
?>

<ul class="nav nav-tabs p-b">
    <li class="<?=(empty($filters['status']) ? 'active' : '')?>"><a href="/">All orders</a></li>
    <? if ($statuses) : ?>
        <? foreach ($statuses as $key => $status) : ?>
            <li class="<?=(!empty($filters['status']) && $key == $filters['status'] ? 'active' : '')?>">
                <a href="<?=UrlHelp::generateUrl('orders/index', ['status' => $key], ['service', 'mode', 'per-page', 'page'])?>"><?=$status?></a>
            </li>
        <? endforeach; ?>
    <? endif; ?>
    <li class="pull-right custom-search">
        <form class="form-inline" action="/admin/orders" method="get">
            <div class="input-group">
                <input type="text" name="search" class="form-control" value="" placeholder="Search orders">
                <span class="input-group-btn search-select-wrap">

            <select class="form-control search-select" name="search-type">
              <option value="1" selected="">Order ID</option>
              <option value="2">Link</option>
              <option value="3">Username</option>
            </select>
            <button type="submit" class="btn btn-default"><span class="glyphicon glyphicon-search" aria-hidden="true"></span></button>
            </span>
            </div>
        </form>
    </li>
</ul>
<table class="table order-table">
    <thead>
    <tr>
        <th>ID</th>
        <th>User</th>
        <th>Link</th>
        <th>Quantity</th>
        <th class="dropdown-th">
            <div class="dropdown">
                <button class="btn btn-th btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                    Service
                    <span class="caret"></span>
                </button>
                <? if ($services) : ?>
                    <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
                        <li class="<?=(empty($filters['service']) ? 'active' : '')?>"><a href="">All (<?=$totalRows?>)</a></li>
                        <? foreach ($services as $key => $service) : ?>
                            <li class="<?=(!empty($filters['service']) && $key == $filters['service'] ? 'active' : '')?>">
                                <a href="<?=UrlHelp::generateUrl('orders/index', ['service' => $key], ['per-page', 'page'])?>">
                                    <span class="label-id"><?=$service['totalOrders']?></span>  <?=$service['name']?>
                                </a>
                            </li>
                        <? endforeach; ?>
                    </ul>
                <? endif; ?>
            </div>
        </th>
        <th>Status</th>
        <th class="dropdown-th">
            <div class="dropdown">
                <button class="btn btn-th btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                    Mode
                    <span class="caret"></span>
                </button>
                <? if ($modes) : ?>
                    <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
                        <? foreach ($modes as $id => $mod) : ?>
                            <li class="<?=(!empty($filters['mode']) && $id == $filters['mode'] ? 'active' : '')?>">
                                <a href="<?=UrlHelp::generateUrl('orders/index', ['mode' => $id], ['per-page', 'page'])?>">
                                    <?=$mod?>
                                </a>
                            </li>
                        <? endforeach; ?>
                    </ul>
                <? endif; ?>
            </div>
        </th>
        <th>Created</th>
    </tr>
    </thead>
    <tbody>
        <? if (!empty($orders)) : ?>
            <? foreach ($orders as $order) : ?>
                <tr>
                    <td><?=$order->id?></td>
                    <td><?=$order->user?></td>
                    <td class="link"><?=$order->link?></td>
                    <td><?=$order->quantity?></td>
                    <td class="service">
                        <span class="label-id"><?=$order->services['totalOrders']?></span> <?=$order->services['name']?>
                    </td>
                    <td><?=$order->statusName?></td>
                    <td><td><?=$order->modeName?></td></td>
                    <td><span class="nowrap"><?=$order->dateCreate?></span><span class="nowrap"><?=$order->timeCreate?></span></td>
                </tr>
            <? endforeach; ?>
        <? endif; ?>
    </tbody>
</table>
<div class="row">
    <div class="col-sm-8">
        <nav>
            <?= \yii\widgets\LinkPager::widget([
                'pagination' => $paginator,
            ]); ?>
        </nav>
    </div>
    <div class="col-sm-4 pagination-counters">
        <?=$pageFrom?> to <?=$pageTo?> of <?=$totalRows?>
    </div>
</div>