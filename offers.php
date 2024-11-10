<?php

include "connect.php";

$stmt = $con->prepare("SELECT items1view.* , 1 AS favorite , (item_price - (item_price * item_discount / 100 )) as itempricediscount  FROM items1view
INNER JOIN favorite ON favorite.favorite_itemsid = items1view.item_id 
WHERE item_discount != 0 
UNION ALL
SELECT * , 0 AS favorite , (item_price - (item_price * item_discount / 100 )) as itempricediscount FROM items1view
WHERE item_discount != 0 AND item_id NOT IN ( SELECT items1view.item_id  FROM items1view
INNER JOIN favorite ON favorite.favorite_itemsid = items1view.item_id )");

$stmt->execute();
$data = $stmt->fetchAll(PDO::FETCH_ASSOC);
$count  = $stmt->rowCount();
if ($count > 0) {
   echo json_encode(array("status" => "success", "data" => $data));
} else {
   echo json_encode(array("status" => "failuer"));
}
