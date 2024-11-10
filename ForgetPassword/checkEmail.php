<?php

include "../connect.php";
$verfiycode     = rand(10000, 99999);

$email = filterRequest("email");
$stmt = $con->prepare("SELECT * FROM users WHERE user_email = ? ");
$stmt->execute(array($email));
$count = $stmt->rowCount();
result($count);

if ($count > 0) {
    $data = array("user_verifycode" => $verfiycode);
    updateData("users", $data, "user_email = '$email'", json: false);
}
