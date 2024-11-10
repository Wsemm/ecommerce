<?php

include "C:/Program Files/XAMPP/htdocs/ecommerce/connect.php";

$id = filterRequest("id");

getAllData("ordersdelivered", "ordersdelivered_deliveryid=$id");
