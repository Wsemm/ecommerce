<?php 

include "C:/Program Files/XAMPP/htdocs/ecommerce/connect.php";

$email  = filterRequest("email") ; 

$verfiy = filterRequest("verifycode") ; 

$stmt = $con->prepare("SELECT * FROM deliverys WHERE delivery_email = '$email' AND delivery_verifycode = '$verfiy' ") ; 
 
$stmt->execute() ; 

$count = $stmt->rowCount() ; 

if ($count > 0) {
 
    $data = array("delivery_approve" => "1") ; 

    updateData("deliverys" , $data , "delivery_email = '$email'");

}else {
 printFailure("verifycode not Correct") ; 

}
?>