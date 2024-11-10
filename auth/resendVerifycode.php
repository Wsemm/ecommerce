<?php
include "../connect.php";


$email = filterRequest("email");
$verfiycode     = rand(10000, 99999);

$data=array("user_verifycode" => $verfiycode);

updateData("users", $data ,"user_email = '$email'");


