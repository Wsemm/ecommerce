<?php
include "connect.php";

$alldata = array();

$categories = getAllData("categories", null, null, false);

$alldata['status'] = 'success';

$alldata['categories'] = $categories;

$items = getAllData("itemstopselling", "1=1 ORDER BY countitems DESC", null, false);

$alldata['items'] = $items;


echo json_encode($alldata);
