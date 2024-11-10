<?php
include "C:/Program Files/XAMPP/htdocs/ecommerce/connect.php";


$userid = filterRequest("userid");
getAllData("myfavorite", "user_id=$userid");
