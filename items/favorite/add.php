<?php

include "C:/Program Files/XAMPP/htdocs/ecommerce/connect.php";




$userid = filterRequest("userid");
$itemsid = filterRequest("itemsid");

$data = array(
    "favorite_userid" => $userid,
    "favorite_itemsid" => $itemsid,

);

insertData("favorite", $data);
