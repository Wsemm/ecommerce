<?php

include "C:/Program Files/XAMPP/htdocs/ecommerce/connect.php";

$orderid = filterRequest("orderid");

$data = array(
    "order_status" => "1",
);
updateData("orders", $data, "order_status = '2' AND order_id = $orderid", false);
deleteData("ordersdelivery", "ordersdelivery_orderid= '$orderid'");

