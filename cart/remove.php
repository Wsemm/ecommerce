<?php

include "../connect.php";

$userid = filterRequest("userid");
$itemid = filterRequest("itemid");

$data = array(
    "cart_userid" => $userid,
    "cart_itemid" => $itemid,
);

// insertData("favorite", $data);
deleteData("cart", "cart_id = (SELECT cart_id FROM  cart WHERE cart_userid = $userid AND cart_itemid= $itemid AND cart_orders = 0 LIMIT 1)");
