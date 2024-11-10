<?php

include "C:/Program Files/XAMPP/htdocs/ecommerce/connect.php";

// $password = sha1($_POST["password"]);
$password = filterRequest("password");
$email = filterRequest("email");
$token = filterRequest("token");

$data=array("delivery_token" => $token);
updateData("deliverys", $data, "delivery_email= '$email' AND delivery_password= '$password'",false);


getData("deliverys" , "delivery_email = ? AND  delivery_password = ?",array($email,$password));


// getData("deliverys" , "delivery_email = ? AND  delivery_password = ? AND delivery_approve = 1  ",array($email,$password));

 
