<?php

include "../connect.php";
$table = "address";

$addressid = filterRequest("addressid");
$userid    = filterRequest("userid");
$name=filterRequest("name");
$city      = filterRequest("city");
$street    = filterRequest("street");
$lat       = filterRequest("lat");
$lang      = filterRequest("lang");

$data = array(
    "address_userid" => $userid,
    "address_city" => $city,
    "address_street" => $street,
    "address_lat" => $lat,
    "address_lang" => $lang,
    "address_name" => $name,


);
$count = updateData($table, $data, "address_id = $addressid");
