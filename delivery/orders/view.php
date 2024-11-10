<?php

include "C:/Program Files/XAMPP/htdocs/ecommerce/connect.php";

$orderstatus = filterRequest("orderstatus");


getAllData('ordersview', "order_status =  '$orderstatus'");



