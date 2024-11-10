<?php

include "../connect.php";
$id = filterRequest("id");

deleteData("users", "user_id= '$id'");
