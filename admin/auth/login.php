<?php

include "../../connect.php";
// $password = sha1($_POST["password"]);
$password = filterRequest("password");
$email = filterRequest("email");
$token = filterRequest("token");


$data=array("admin_token" => $token);
updateData("admins", $data, "admin_email= '$email' AND admin_password= '$password'",false);

getData("admins" , "admin_email = ? AND  admin_password = ?",array($email,$password));






 
