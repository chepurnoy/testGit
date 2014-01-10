<?php

$this->widget('bootstrap.widgets.TbListView', array(
    'dataProvider' => $dataProvider,
    'itemView' => '_search',
    'itemsTagName' => 'table',
    'itemsCssClass' => 'items table table-striped table-condensed',
    'emptyText' => '<i> Sorry, there are no active items to display</i>',
));
