<?php
include "connect.php";

$alldata = array();

$categories = getAllData("categories", null, null, false);

$alldata['status'] = 'success';

$alldata['categories'] = $categories;

$items = getAllData("items1view", "item_discount !=0", null, false);

$alldata['items'] = $items;

$items = getAllData("text", "1=1", null, false);

$alldata['text'] = $items;




echo json_encode($alldata);
