<?php

include "C:/Program Files/XAMPP/htdocs/ecommerce/connect.php";


$orderid = filterRequest("orderid");
$id = filterRequest("id");
$price = filterRequest("price");
$pricedelivery = filterRequest("pricedelivery");


$data = array(
    "order_status" => "3",
);
$data2 = array(

    "ordersdelivered_deliveryid" => "$id",
    "ordersdelivered_orderid" => "$orderid",
    "ordersdelivered_price" => "$price",
    "ordersdelivered_pricedelivery" => "$pricedelivery",
);
$data3 = array(
    "ordersdelivery_done" => "1",

);
updateData("orders", $data, "order_status = '2' AND order_id = $orderid", false);
updateData("ordersdelivery", $data3, "ordersdelivery_done = '0' AND ordersdelivery_orderid = $orderid", false);
// deleteData("ordersdelivery", "ordersdelivery_orderid= '$orderid'", false);
insertData("ordersdelivered", $data2, true);
