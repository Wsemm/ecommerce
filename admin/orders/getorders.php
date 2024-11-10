<?php

include "../../connect.php";

$status = filterRequest("status");
getAllData("orders", "order_status= '$status'");
