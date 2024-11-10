<?php

include "C:/Program Files/XAMPP/htdocs/ecommerce/connect.php";
$id = filterRequest("id");

getAllData("ordersdeliveryview", "ordersdelivery_deliveryid='$id' AND order_status='2'");
