<?php
include "../connect.php";
$userid = filterRequest("userid");
$addressid = filterRequest("addressid");
$orderstype = filterRequest("orderstype");
$pricedelivery = filterRequest("pricedelivery");
$ordersprice = filterRequest("ordersprice");
$couponid = filterRequest("couponid");
$paymentmethod = filterRequest("paymentmethod");
$coupondiscount = filterRequest("coupondiscount");


$toatlPrice = $ordersprice + $pricedelivery;
// check coupon
$now = date("y-m-d H:i:s");
$checkcoupon = getData("coupon", "coupon_id = '$couponid' AND 	coupon_expire_date > '$now' AND coupon_count > 0", null, false);

if ($checkcoupon > 0) {
    $toatlPrice = $toatlPrice - $ordersprice * $coupondiscount / 100;
    $stmt = $con->prepare("UPDATE `coupon` SET `coupon_count`= `coupon_count`  - 1 WHERE coupon_id='$couponid'");
    $stmt->execute();
}
$data = array(
    "order_userid" => $userid,
    "order_address" => $addressid,
    "order_type" => $orderstype,
    "order_pricedelivry" => $pricedelivery,
    "order_price" => $ordersprice,
    "order_coupon" => $couponid,
    "order_totalprice" => intval($toatlPrice),
    "order_paymentmethod" => $paymentmethod,


);
$count = insertData("orders", $data, true);
if ($count > 0) {
    $stmt = $con->prepare("SELECT Max(order_id) from orders ");
    $stmt->execute();
    $maxid = $stmt->fetchColumn();

    $data = array("cart_orders" => $maxid);

    updateData("cart", $data, "cart_userid = $userid AND cart_orders = 0 ", false);
}
