<ul class="nav nav-tabs p-b">
    <li class="active"><a href="#">All orders</a></li>
    <li><a href="#">Pending</a></li>
    <li><a href="#">In progress</a></li>
    <li><a href="#">Completed</a></li>
    <li><a href="#">Canceled</a></li>
    <li><a href="#">Error</a></li>
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
                <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
                    <li class="active"><a href="">All (894931)</a></li>
                    <li><a href=""><span class="label-id">214</span>  Real Views</a></li>
                    <li><a href=""><span class="label-id">215</span> Page Likes</a></li>
                    <li><a href=""><span class="label-id">10</span> Page Likes</a></li>
                    <li><a href=""><span class="label-id">217</span> Page Likes</a></li>
                    <li><a href=""><span class="label-id">221</span> Followers</a></li>
                    <li><a href=""><span class="label-id">224</span> Groups Join</a></li>
                    <li><a href=""><span class="label-id">230</span> Website Likes</a></li>
                </ul>
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
                            <li class=""><a href=""><?=$mod?></a></li>
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
                        <span class="label-id"><?=$order->services['totalOrders']?></span><?=$order->services['name']?>
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