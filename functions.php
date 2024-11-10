<?php

// ==========================================================
//  Copyright Reserved Wael Wael Abo Hamza (Course Ecommerce)
// ==========================================================
require 'vendor/autoload.php';

use Google\Auth\Credentials\ServiceAccountCredentials;
use Google\Cloud\Core\ServiceBuilder;

define("MB", 1048576);

function filterRequest($requestname)
{
    return  htmlspecialchars(strip_tags($_POST[$requestname]));
}

function getData($table, $where = null, $values = null, $json = true)
{
    global $con;
    $data = array();
    $stmt = $con->prepare("SELECT  * FROM $table WHERE   $where ");
    $stmt->execute($values);
    $data = $stmt->fetch(PDO::FETCH_ASSOC);
    $count  = $stmt->rowCount();
    if ($json == true) {
        if ($count > 0) {
            echo json_encode(array("status" => "success", "data" => $data));
        } else {
            echo json_encode(array("status" => "failure"));
        }
    } else {
        return $count;
    }
}

function getOneData($table, $column, $where = null, $values = null, $json = true)
{
    global $con;
    $data = array();
    $stmt = $con->prepare("SELECT $column FROM $table WHERE   $where ");
    $stmt->execute($values);
    $data = $stmt->fetch(PDO::FETCH_ASSOC);
    $count  = $stmt->rowCount();
    if ($json == true) {
        if ($count > 0) {
            echo json_encode(array("status" => "success", "data" => $data));
        } else {
            echo json_encode(array("status" => "failure"));
        }
    }
    if ($count > 0) {
        json_encode($data);
        return $data["user_token"];
        if ($json == false) {
        }
    } else {
        return $count;
    }
}


// function getData($table, $where = null, $values = null, $json = true)
// {
//     global $con;
//     $data = array();
//     $stmt = $con->prepare("SELECT  * FROM $table WHERE   $where ");
//     $stmt->execute($values);
//     $data = $stmt->fetch(PDO::FETCH_ASSOC);
//     $count  = $stmt->rowCount();
//     if ($count > 0) {
//         if ($json == true) {
//             echo json_encode(array("status" => "success", "data" => $data));
//         } else {
//             echo json_encode(array("status" => "failure"));
//         }
//     } else {

//         return $count;
//     }
// }

function getAllData($table, $where = null, $values = null, $json = true)
{
    global $con;
    $data = array();
    if ($where == null) {
        $stmt = $con->prepare("SELECT  * FROM $table ");
    } else {
        $stmt = $con->prepare("SELECT  * FROM $table WHERE   $where ");
    }
    $stmt->execute($values);
    $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $count  = $stmt->rowCount();
    if ($json == true) {
        if ($count > 0) {
            echo json_encode(array("status" => "success", "data" => $data));
        } else {
            echo json_encode(array("status" => "failure"));
        }
        return $count;
    } else {
        if ($count > 0) {
            return (array("status" => "success", "data" => $data));
        } else {
            return (array("status" => "failure"));
        }
    }
}

function insertData($table, $data, $json = true)
{
    global $con;
    foreach ($data as $field => $v)
        $ins[] = ':' . $field;
    $ins = implode(',', $ins);
    $fields = implode(',', array_keys($data));
    $sql = "INSERT INTO $table ($fields) VALUES ($ins)";

    $stmt = $con->prepare($sql);
    foreach ($data as $f => $v) {
        $stmt->bindValue(':' . $f, $v);
    }
    $stmt->execute();
    $count = $stmt->rowCount();
    if ($json == true) {
        if ($count > 0) {
            echo json_encode(array("status" => "success"));
        } else {
            echo json_encode(array("status" => "failures"));
        }
    }
    return $count;
}


function updateData($table, $data, $where, $json = true)
{
    global $con;
    $cols = array();
    $vals = array();

    foreach ($data as $key => $val) {
        $vals[] = "$val";
        $cols[] = "`$key` =  ? ";
    }
    $sql = "UPDATE $table SET " . implode(', ', $cols) . " WHERE $where";

    $stmt = $con->prepare($sql);
    $stmt->execute($vals);
    $count = $stmt->rowCount();
    if ($json == true) {
        if ($count > 0) {
            echo json_encode(array("status" => "success"));
        } else {
            echo json_encode(array("status" => "failure"));
        }
    }
    return $count;
}

function deleteData($table, $where, $json = true)
{
    global $con;
    $stmt = $con->prepare("DELETE FROM $table WHERE $where");
    $stmt->execute();
    $count = $stmt->rowCount();
    if ($json == true) {
        if ($count > 0) {
            echo json_encode(array("status" => "success"));
        } else {
            echo json_encode(array("status" => "failure"));
        }
    }
    return $count;
}

function imageUpload($imageRequest)
{
    global $msgError;
    $imagename  = rand(1000, 10000) . $_FILES[$imageRequest]['name'];
    $imagetmp   = $_FILES[$imageRequest]['tmp_name'];
    $imagesize  = $_FILES[$imageRequest]['size'];
    $allowExt   = array("jpg", "png", "gif", "mp3", "pdf");
    $strToArray = explode(".", $imagename);
    $ext        = end($strToArray);
    $ext        = strtolower($ext);

    if (!empty($imagename) && !in_array($ext, $allowExt)) {
        $msgError = "EXT";
    }
    if ($imagesize > 2 * MB) {
        $msgError = "size";
    }
    if (empty($msgError)) {
        move_uploaded_file($imagetmp,  "../upload/" . $imagename);
        return $imagename;
    } else {
        return "fail";
    }
}



function deleteFile($dir, $imagename)
{
    if (file_exists($dir . "/" . $imagename)) {
        unlink($dir . "/" . $imagename);
    }
}

function checkAuthenticate()
{
    if (isset($_SERVER['PHP_AUTH_USER'])  && isset($_SERVER['PHP_AUTH_PW'])) {
        if ($_SERVER['PHP_AUTH_USER'] != "wael" ||  $_SERVER['PHP_AUTH_PW'] != "wael12345") {
            header('WWW-Authenticate: Basic realm="My Realm"');
            header('HTTP/1.0 401 Unauthorized');
            echo 'Page Not Found';
            exit;
        }
    } else {
        exit;
    }

    // End 
}
function   printFailure($message = "none")
{
    echo     json_encode(array("status" => "failure", "message" => $message));
}
function   printSuccess($message = "none")
{
    echo     json_encode(array("status" => "success", "message" => $message));
}
function result($count)
{
    if ($count > 0) {
        printSuccess();
    } else {
        printFailure();
    }
}





function sendEmail($to, $title, $body)
{
    $header = "From: support@waelabohamza.com " . "\n" . "CC: waeleagle1243@gmail.com";
    mail($to, $title, $body, $header);
    echo "Success";
}




class NotificationService4
{
    private static function getAccessToken()
    {
        $serviceAccountJson = [
            "type" => "service_account",
            "project_id" => "ecommerce-c5fd4",
            "private_key_id" => "925cdc35fbfbe8d5b181c9da6d0de9a3adafbc35",
            "private_key" => "-----BEGIN PRIVATE KEY-----\nMIIEvgIBADANBgkqhkiG9w0BAQEFAASCBKgwggSkAgEAAoIBAQDagwT1QaGL3PEQ\nyZsNLVdaplqHvuXvKH/bRlvbQL7DZp72pLT6dUdTrxFNrwerPo4KEbxZoi0DMouh\nfxjjcyV2jpdGWueVFFnLKVYzYLzUUnlFl7WuJdy9DwkvQ9B2sqyaETkSPubFqzTQ\n1rls9KtHgB0NvuOvM4NOEIN9f9UZQIHG0JtuD89Dd4XhxL696yOaQNK13JLl/LqB\nF06moqXj0KALw53k5RJRgLJdKEHaTAbb8USo8er0CXfhm7xi+MCowg3/8+Bkj1Lh\nfm/Q5TcPPps3Id0admrw71w615gyHEEUJIA9a9yni8nQ2GQI6riWdIXiY07XKbpt\nu8ld/mCVAgMBAAECggEAJ4j0ETHOOkF/5kMryA8PkomtsIjUDljcBT7uKLXGrhD3\nqvVy/yvP+26d6VnFP/EB/wVleCw1C7KN++rEhIaVXSWAbkzNQLZdZro0a/hRQfMo\nGPTRfNBB53z8cu5InelG/FsoYco6s8H9vNlU1EdSZA3kc9O5Wz4tQCcRu1exJS+m\nhlMTFy/ckg/+VPt4JPxvVtG8Nm0Ss7gMTKxWlc7FY8G6VIK3+MkN6mWAtvHKb8BQ\nGfMMQYzN2dpH2dZpMni0ILHWGkYUvGABcG5ePo21aZA3oEcryf91cGwGbH6gx3a0\nksoXIzrCEA75iWtWWvUZlHNdeWzVUPbNt+3it3JW4QKBgQD1efnMHdyxOPTdMv6M\nnpjKz9qXzU4eU14ZL/gJBPePsL2N+fhR0IM71UfHLQNOHTEFbWTnnm8tqoVFeX3W\nLXhQ2Jg4KGt1oO7ymthePGJ7zo5FmhT+9QRrlfX2E4jM38jhPfxyzCO9UMEPxblh\nYYnHvoQAo64KBfXsfvDttvjf0QKBgQDj4R12x24NPC/aln11ErCiBHaYLCiSHKir\nQRE2JgbyWWTJJ+lnh+W5nC1HighyCZ/1TbUF8jBHlmT+0Mcu9UN/ZzHsz53E4W0E\npo3qsuCrRTsLUsk5ynuFGGy5S4uFKfFFGQmwKwUwIQWcURMTfMh7923ng9pw6yaO\nIVIllEfJhQKBgQC409N6lc1yfuEXn+q7dDq1EhWTkNjNypWiP1TxbZT80uWWfe0z\npNz68xataD4B1cbwQDLmlos9hhP8gIJ3/hqGPN84AW8PzVG8x0w8gBjjAV5sF5zR\nbyiZ3PqqAoFRSPoWZjarNPt/8sq6lnSDVw6Hn/ICDTvgfiZxoA7F3au70QKBgHPy\nnQ1M2AA/+ZFdNSSWh+1IHBe9kD8X+fJ5PwqwOqShO5jmh+o3yXmxr5BQ+Y8cupkU\nGuGVo18pdOX60P5hqSBwH4UA9qOwl8nf/SHINmyu4yYVz3FqR4MnNFrrx2fQOYUR\nAk7y9MbSZops7iniOhhpgzBjdIgz/gAfkC6yzfwJAoGBAKNfbqF2hP9SYs8gfd/O\nUrHbIRe9LYcUBq/bhYxrG/omVADSX8wPMjXAIhK1gg4YfPxGL/7Vw6bPWMCFw85J\nA94qx7S+N6iZ7HKzcaseKFrFxRtbfuaTn7TUZ7wIaJMrT6cTaNvFlRXJDAiAqQHY\niOG8McpN3kg/ldwoa4QsA3DN\n-----END PRIVATE KEY-----\n",
            "client_email" => "firebase-adminsdk-xrih3@ecommerce-c5fd4.iam.gserviceaccount.com",
            "client_id" => "104523272552120647785",
            "auth_uri" => "https=>//accounts.google.com/o/oauth2/auth",
            "token_uri" => "https://oauth2.googleapis.com/token",
            "auth_provider_x509_cert_url" => "https://www.googleapis.com/oauth2/v1/certs",
            "client_x509_cert_url" => "https://www.googleapis.com/robot/v1/metadata/x509/firebase-adminsdk-xrih3%40ecommerce-c5fd4.iam.gserviceaccount.com",
            "universe_domain" => "googleapis.com"
        ];

        $scopes = [
            "https://www.googleapis.com/auth/userinfo.email",
            "https://www.googleapis.com/auth/firebase.database",
            "https://www.googleapis.com/auth/firebase.messaging"
        ];

        $credentials = new ServiceAccountCredentials($scopes, $serviceAccountJson);
        return $credentials->fetchAuthToken()['access_token'];
    }

    public static function sendNotificationToAllUsers($title, $body, $topic)
    {
        $accessToken = self::getAccessToken();
        $endpointFCM = 'https://fcm.googleapis.com/v1/projects/ecommerce-c5fd4/messages:send';

        $message = [
            "message" => [
                "topic" => "$topic", // Send to the topic `allUsers`
                "notification" => ["title" => $title, "body" => $body],
                "data" => [
                    "route" => "serviceScreen",
                ]
            ]
        ];

        $options = [
            'http' => [
                'header'  => [
                    "Content-Type: application/json",
                    "Authorization: Bearer $accessToken"
                ],
                'method'  => 'POST',
                'content' => json_encode($message)
            ]
        ];

        $context  = stream_context_create($options);
        $result = file_get_contents($endpointFCM, false, $context);

        if ($result === FALSE) {
            echo 'Failed to send notification';
        } else {
            echo 'Notification sent successfully';
        }
    }

    public static function sendNotificationToUser($userId, $title, $body)
    {
        // Retrieve the device token for the specified user ID from your database
        $deviceToken = self::getDeviceTokenForUserId($userId);

        if (!$deviceToken) {
            echo 'No device token found for user ID: ' . $userId;
            return;
        }

        $accessToken = self::getAccessToken();
        $endpointFCM = 'https://fcm.googleapis.com/v1/projects/ecommerce-c5fd4/messages:send';

        $message = [
            "message" => [
                "token" => $deviceToken,
                "notification" => ["title" => $title, "body" => $body],
                "data" => [
                    "route" => "serviceScreen",
                ]
            ]
        ];

        $options = [
            'http' => [
                'header'  => [
                    "Content-Type: application/json",
                    "Authorization: Bearer $accessToken"
                ],
                'method'  => 'POST',
                'content' => json_encode($message)
            ]
        ];

        $context  = stream_context_create($options);
        $result = file_get_contents($endpointFCM, false, $context);

        if ($result === FALSE) {
            echo 'Failed to send notification';
        } else {
            echo 'Notification sent successfully';
        }
    }

    private static function getDeviceTokenForUserId($userId)
    {
        $userId = getOneData("users", "user_token", "user_id=$userId", null, false);
        return $userId;
    }
}







// function sendGCM($title, $message, $topic, $pageid, $pagename)
// {


//     $url = 'https://fcm.googleapis.com/fcm/send';

//     $fields = array(
//         "to" => '/topics/' . $topic,
//         'priority' => 'high',
//         'content_available' => true,

//         'notification' => array(
//             "body" =>  $message,
//             "title" =>  $title,
//             "click_action" => "FLUTTER_NOTIFICATION_CLICK",
//             "sound" => "default"

//         ),
//         'data' => array(
//             "pageid" => $pageid,
//             "pagename" => $pagename
//         )

//     );


//     $fields = json_encode($fields);
//     $headers = array(
//         'Authorization: key=' . "",
//         'Content-Type: application/json'
//     );

//     $ch = curl_init();
//     curl_setopt($ch, CURLOPT_URL, $url);
//     curl_setopt($ch, CURLOPT_POST, true);
//     curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
//     curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
//     curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);

//     $result = curl_exec($ch);
//     return $result;
//     curl_close($ch);
// }
