<?php

include "../../connect.php";
$id = filterRequest("id");


$data = array(

    "order_status" => 1,
);
updateData("orders", $data, "order_id = '$id'");
