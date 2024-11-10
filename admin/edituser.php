<?php

include "../connect.php";

$id = filterRequest("id");
$name = filterRequest("name");
$email = filterRequest("email");
$phone = filterRequest("phone");
$verify = filterRequest("verify");
$approve = filterRequest("approve");
$date = filterRequest("date");

$data = array(

    "user_name" => "$name",
    "user_email" => "$email",
    "user_phone" => "$phone",
    "user_verifycode" => "$verify",
    "user_approve" => "$approve",
    "user_create" => "$date",

);
updateData("users", $data, "user_id=$id");
