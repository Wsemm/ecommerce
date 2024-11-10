<?php

include "C:/Program Files/XAMPP/htdocs/ecommerce/connect.php";


$id = filterRequest("id");



getAllData("myfavorite", "favorite_userid= ? ", array($id));
