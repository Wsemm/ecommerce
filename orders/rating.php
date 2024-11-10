<?php

include "../connect.php";


$rating = filterRequest("rating");
$ratingnote = filterRequest("ratingnote");
$id = filterRequest("id");
$data = array(
    "orders_rating" => $rating,
    "orders_noterating" => $ratingnote,
);
updateData("orders", $data, "order_id =$id");
