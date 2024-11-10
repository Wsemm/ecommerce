<?php

include "../connect.php";

$name = filterRequest("name");
$namear = filterRequest("namear");
$imgae = filterRequest("image");
$data = array(

    "categories_name" => $name,
    "categories_name_ar" => $namear,
    "categories_image" => $imgae,
);
insertData("categories", $data,);
