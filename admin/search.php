<?php

include "../connect.php";
$id = filterRequest("id");
$category = filterRequest("category");
// $name = filterRequest("name");
if ($category == "users") {
    getAllData("users", "user_id = '$id'");
}
if ($category == "admins") {
    getAllData("admins", "admin_id = '$id'");
}
if ($category == "delivery") {
    getAllData("deliverys", "delivery_id = '$id'");
}

if ($category == "category") {
    getAllData("categories", "categories_id ='$id' ");

    // getAllData("categories", "categories_id='$id' OR categories_name LIKE '%$name%'");
}

if ($category == "items") {

    $stmt = $con->prepare("SELECT * FROM items WHERE item_id = '$id'");
    $stmt->execute();
    $count = $stmt->rowCount();
    $data = $stmt->fetchAll(PDO::FETCH_ASSOC);


    if ($count > 0) {
        echo json_encode(array("status" => "success", "data" => $data));
    } else {
        $stmt2 = $con->prepare("SELECT * FROM items WHERE item_name LIKE '%$id%'");
        $stmt2->execute();
        $count2 = $stmt2->rowCount();
        $data2 = $stmt2->fetchAll(PDO::FETCH_ASSOC);
        if ($count2 > 0) {
            echo json_encode(array("status" => "success", "data" => $data2));
        } else {
            echo json_encode(array("status" => "failuer"));
        }
    }
}
