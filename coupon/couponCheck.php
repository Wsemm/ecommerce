<?php
include '../connect.php';


$CouponName = filterRequest("couponname");
$now=date("y-m-d H:i:s");

getData("coupon", "coupon_name = '$CouponName' AND 	coupon_expire_date > '$now' AND coupon_count > 0");
?>