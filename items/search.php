<?php

include "../connect.php";

$search = filterRequest("search");

getAllData("items1view", "item_name LIKE '%$search%' OR item_name_ar LIKE '%$search%'");
