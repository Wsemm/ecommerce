<?php

include "../connect.php";


$username = filterRequest("username");
$password = sha1($_POST["password"]);
$email = filterRequest("email");
$phone = filterRequest("phone");
$approve = filterRequest("approve");
$verfiycode     = rand(10000, 99999);

$stmt = $con->prepare("SELECT admins.admin_email,admins.admin_phone,users.user_email,users.user_phone,deliverys.delivery_email,deliverys.delivery_phone FROM admins,users,deliverys WHERE admin_email = '$email' OR admin_phone ='$phone' OR  user_email ='$email'OR user_phone ='$phone' OR delivery_phone ='$phone' OR delivery_email='$email'");
$stmt->execute();

$count = $stmt->rowCount();
if ($count > 0) {
    printFailure("PHONE OR EMAIL");
} else {

    $data = array(
        "delivery_name" => $username,
        "delivery_password" =>  $password,
        "delivery_email" => $email,
        "delivery_phone" => $phone,
        "delivery_approve" => $approve,
        "delivery_verifycode" => $verfiycode,


    );
    // sendEmail($email , "Verfiy Code Ecommerce" , "Verfiy Code $verfiycode") ; 
    insertData("deliverys", $data);
}
