<?php

include "../connect.php";

// getAllData("users");
$stmt = $con->prepare("SELECT users.user_id,users.user_name,users.user_email,users.user_phone,users.user_verifycode,users.user_approve,users.user_create FROM users");
$stmt->execute();
$count = $stmt->rowCount();
$data = $stmt->fetchAll(PDO::FETCH_ASSOC);


if ($count > 0) {
    echo json_encode(array("status" => "success", "data" => $data));
} else {
    echo json_encode(array("status" => "success", "data" => 0));
}
