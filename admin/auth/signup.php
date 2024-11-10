<?php

include "../../connect.php";


$username = filterRequest("username");
$password = sha1($_POST["password"]);
$email = filterRequest("email");
$phone = filterRequest("phone");
$permition = filterRequest("permition");
// $verfiycode     = rand(10000, 99999);
$stmt = $con->prepare("SELECT admins.admin_email,admins.admin_phone,users.user_email,users.user_phone,deliverys.delivery_email,deliverys.delivery_phone FROM admins,users,deliverys WHERE admin_email = '$email' OR admin_phone ='$phone' OR  user_email ='$email'OR user_phone ='$phone' OR delivery_phone ='$phone' OR delivery_email='$email'");
$stmt->execute();

$count = $stmt->rowCount();
if ($count > 0) {
    printFailure("PHONE OR EMAIL");
} else {

    $data = array(
        "admin_name" => $username,
        "admin_password" =>  $password,
        "admin_email" => $email,
        "admin_phone" => $phone,
        "admin_permition" => $permition,

    );
    // sendEmail($email , "Verfiy Code Ecommerce" , "Verfiy Code $verfiycode") ; 
    insertData("admins", $data);
}
