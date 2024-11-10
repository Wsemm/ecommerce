<?php

include "../connect.php";

$categoryid = filterRequest("id");

// getAllData("itemsview", "categories_id = $categoryid");

$userid = filterRequest("userid");

$stmt = $con->prepare("SELECT items1view.* , 1 AS favorite , (item_price - (item_price * item_discount / 100 )) as itempricediscount  FROM items1view
INNER JOIN favorite ON favorite.favorite_itemsid = items1view.item_id AND favorite.favorite_userid=$userid
WHERE categories_id = $categoryid
UNION ALL
SELECT * , 0 AS favorite , (item_price - (item_price * item_discount / 100 )) as itempricediscount FROM items1view
WHERE categories_id = $categoryid AND item_id NOT IN ( SELECT items1view.item_id  FROM items1view
INNER JOIN favorite ON favorite.favorite_itemsid = items1view.item_id AND favorite.favorite_userid=$userid )");

$stmt->execute();
$data = $stmt->fetchAll(PDO::FETCH_ASSOC);
$count  = $stmt->rowCount();
if ($count > 0) {
    echo json_encode(array("status" => "success", "data" => $data));
} else {
    echo json_encode(array("status" => "failuer"));
}
