<?php

include "../connect.php";

$userid = filterRequest("userid");

getAllData('ordersview', "order_userid =  '$userid' AND order_status=1");



