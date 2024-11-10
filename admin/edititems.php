<?php

include "../connect.php";

$id = filterRequest("id");
$name = filterRequest("name");
$namear = filterRequest("name_ar");
$item_desc = filterRequest("item_desc");
$item_desc_ar = filterRequest("item_desc_ar");
$item_desc_short = filterRequest("item_desc_short");
$item_desc_short_ar = filterRequest("item_desc_short_ar");
$item_image = filterRequest("item_image");
$item_count = filterRequest("item_count");
$item_active = filterRequest("item_active");
$item_price = filterRequest("item_price");
$item_discount = filterRequest("item_discount");
$item_cat = filterRequest("item_cat");

$data = array(
    "item_name" => $name,
    "item_name_ar" => $namear,
    "item_desc" => $item_desc,
    "item_desc_ar" => $item_desc_ar,
    "item_desc_short" => $item_desc_short,
    "item_desc_short_ar" => $item_desc_short_ar,
    "item_image" => $item_image,
    "item_count" => $item_count,
    "item_active" => $item_active,
    "item_price" => $item_price,
    "item_discount" => $item_discount,
    "item_cat" => $item_cat,
);
updateData("items", $data, "item_id= $id ");
