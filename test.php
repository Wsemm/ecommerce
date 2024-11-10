<?php
include "connect.php";

NotificationService4::sendNotificationToUser("71","test","test body");
// sendGCM("hello","test hello","users","","");
// $table = "users";

// $data = array(
//     "user_name" => "wsem_New_2",
//     "user_email" => "wsem_2_New@gmail.com",
//     "user_phone" => "555544445",
//     "user_verifycode" => "859764",
// );
// $count = insertData($table,$data);
