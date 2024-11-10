<?php

include "C:/Program Files/XAMPP/htdocs/ecommerce/connect.php";



$id = filterRequest("id");


deleteData("favorite", "favorite_id=$id");
