<?php

include "../connect.php";

$id = filterRequest("id");
$name = filterRequest("name");
$email = filterRequest("email");
$phone = filterRequest("phone");
$permition = filterRequest("permition");


$data = array(
    "admin_name" => $name,
    "admin_email" => $email,
    "admin_phone" => $phone,
    "admin_permition" => $permition,
);
updateData("admins", $data, "admin_id = $id");
