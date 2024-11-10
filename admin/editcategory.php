<?php

include "../connect.php";

$id = filterRequest("id");
$name = filterRequest("name");
$nameAr = filterRequest("namear");
$image = filterRequest("image");
$date = filterRequest("date");

$data = array(

    "categories_name" => "$name",
    "categories_name_ar" => "$nameAr",
    "categories_image" => "$image",
    "categories_datatime" => "$date",

);
updateData("categories", $data, "categories_id =$id");
