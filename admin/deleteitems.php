<?php

include "../connect.php";
$id = filterRequest("id");

deleteData("items", "item_id= '$id'");



