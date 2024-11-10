<?php

include "../connect.php";

$id=filterRequest("id");
$token = filterRequest("token");
$data = array(
    "user_token" => "$token"
);
updateData("users", $data, "user_id=$id");

