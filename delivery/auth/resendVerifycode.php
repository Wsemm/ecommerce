<?php
include "C:/Program Files/XAMPP/htdocs/ecommerce/connect.php";


$email = filterRequest("email");
$verfiycode     = rand(10000, 99999);

$data=array("delivery_verifycode" => $verfiycode);

updateData("deliverys", $data ,"delivery_email = '$email'");


