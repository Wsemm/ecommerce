<?php
include "connect.php";

$to = filterRequest("to");
$title = filterRequest("title");
$body = filterRequest("body");

if ($to == "users") {
    NotificationService4::sendNotificationToAllUsers("$title", "$body", "users");
} else   
 if ($to == "deliverys") {
    NotificationService4::sendNotificationToAllUsers("$title", "$body", "deliverys");
}

if ($to == "admins") {
    NotificationService4::sendNotificationToAllUsers("$title", "$body", "admins");
} else {

    NotificationService4::sendNotificationToUser("$to", "$title", "$body");
}
