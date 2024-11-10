<?php

include "../connect.php";

$password = sha1($_POST["password"]);
$email = filterRequest("email");
$token = filterRequest("token");

// $stmt = $con->prepare("SELECT * FROM users WHERE user_email = ? AND  user_password = ? AND user_approve = 1  ");
// $stmt->execute(array($email, $password));
// $count = $stmt->rowCount();
// result($count);


getData("users", "user_email = ? AND  user_password = ?", array($email, $password),true);

$data=array("user_token" => $token);

updateData("users", $data, "user_email= '$email' AND user_password= '$password'",false);


