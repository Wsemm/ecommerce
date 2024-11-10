CREATE OR REPLACE VIEW items1view AS
SELECT items.*,categories.* FROM items
INNER JOIN categories ON items.item_cat =categories.categories_id;



CREATE OR REPLACE VIEW myfavorite AS
SELECT favorite.*,items.* , users.user_id FROM favorite
INNER JOIN users ON users.user_id=favorite.favorite_userid
INNER JOIN items ON items.item_id=favorite.favorite_itemsid

CREATE OR REPLACE VIEW cartview AS 
SELECT SUM(items.item_price - items.item_price*items.item_discount / 100) as itemsprice , COUNT(cart_itemid) as  countitems , cart.* , items.* FROM cart
INNER JOIN items ON  items.item_id = cart.cart_itemid
WHERE cart_orders=0
GROUP BY cart.cart_itemid , cart.cart_userid,cart.cart_orders

CREATE or REPLACE view ordersview AS
SELECT orders.*, address.* FROM orders
LEFT JOIN address ON address.address_id = orders.order_address;



CREATE OR REPLACE VIEW ordersdetailsview AS 
SELECT SUM(items.item_price - items.item_price*items.item_discount / 100) as itemsprice , COUNT(cart_itemid) as  countitems , cart.* , items.* FROM cart
INNER JOIN items ON  items.item_id = cart.cart_itemid
WHERE cart_orders!=0
GROUP BY cart.cart_itemid , cart.cart_userid,cart.cart_orders


CREATE or REPLACE VIEW itemstopselling AS 
SELECT COUNT(cart_id) as countitems , cart.* , items.*  , (item_price - (item_price * item_discount / 100 ))  as itemspricedisount  FROM cart 
INNER JOIN items ON items.item_id = cart.cart_itemid
WHERE cart_orders != 0 
GROUP by cart_itemid   ;



-- ====================delviery===================
CREATE or REPLACE view ordersdeliveryview AS
SELECT ordersdelivery.*, users.user_name,orders.* FROM orders
INNER JOIN ordersdelivery ON ordersdelivery.ordersdelivery_orderid = orders.order_id
INNER JOIN users ON users.user_id= orders.order_userid;

CREATE or REPLACE view fullordersdetails  AS 
SELECT orders.*,ordersdelivery.*,ordersdelivered.ordersdelivered_id FROM orders
left join ordersdelivery ON orders.order_id = ordersdelivery.ordersdelivery_orderid 
left join ordersdelivered ON orders.order_id = ordersdelivered.ordersdelivered_orderid 

