<?php

include "C:/Program Files/XAMPP/htdocs/ecommerce/connect.php";
$id = filterRequest("id");
$orderid = filterRequest("orderid");
// $address = filterRequest("address");
// $price = filterRequest("price");
// $totalprice = filterRequest("totalprice");
// $orderstatus = filterRequest("orderstatus");

$data = array(
    "order_status" => "2",
);


$data2 = array(
    "ordersdelivery_deliveryid" => $id,
    "ordersdelivery_orderid" => $orderid,
    // "ordersdelivery_address" => $address,
    // "ordersdelivery_pricedelivery"=> $price,
    // "ordersdelivery_totalprice"=> $totalprice,
);
updateData("orders", $data, "order_id = $orderid", true);
insertData("ordersdelivery", $data2, null);
