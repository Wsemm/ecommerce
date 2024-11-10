<?php

include "../../connect.php";
$id = filterRequest("id");
// getAllData("fullordersdetails", "order_id =$id", null, true);
// // getAllData("ordersdetailsview","cart_orders =$id",null,true);


$stmt = $con->prepare("SELECT ordersdetailsview.item_id,ordersdetailsview.item_name,ordersdetailsview.countitems FROM ordersdetailsview WHERE ordersdetailsview.cart_orders=$id ");
$stmt->execute();
$count = $stmt->rowCount();
// $data = $stmt->fetchall();
$data = $stmt->fetchAll(PDO::FETCH_ASSOC);


if ($count > 0) {
    echo json_encode(array("status" => "success","data" => $data));
} else {
    echo json_encode(array("status" => "success", "data" => 0));
}
