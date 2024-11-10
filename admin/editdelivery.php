<?php

include "../connect.php";

$id = filterRequest("id");
$name = filterRequest("name");
$email = filterRequest("email");
$phone = filterRequest("phone");
$approve = filterRequest("approve");

$data = array(
    "delivery_name" => $name,
    "delivery_email" => $email,
    "delivery_phone" => $phone,
    "delivery_approve" => $approve
);
updateData("deliverys", $data, "delivery_id = $id");
