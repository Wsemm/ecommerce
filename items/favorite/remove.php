<?php

include "C:/Program Files/XAMPP/htdocs/ecommerce/connect.php";



$userid = filterRequest("userid");
$itemid = filterRequest("itemsid");

$data = array(
    "favorite_userid" => $userid,
    "favorite_itemsid" => $itemid,
);

// insertData("favorite", $data);
deleteData("favorite", "favorite_userid=$userid AND favorite_itemsid=$itemid");
