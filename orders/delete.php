<?php
include "../connect.php";

$ordersid = filterRequest("ordersid");

deleteData("orders", "order_id = $ordersid AND order_status=0");
