<?php
define("ORDER_STATUS_NEW", "NEW");
define("ORDER_STATUS_CANCELED", "CANCELED");
define("ORDER_STATUS_FAILED", "FAILED");
define("ORDER_STATUS_PAYED", "PAYED");

function takeAllItems() {
    $qr_item = mysql_query("SELECT * FROM item");
    $items = array();
    while ($item = mysql_fetch_array($qr_item)) {
        $items[] = $item;
    }
    return $items;
}

function takeItemCount($itemId, $orderId) {
    $result = mysql_query("SELECT amount FROM order_item WHERE item_id = ".$itemId." AND order_id = ".$orderId);
    $row = mysql_fetch_assoc($result);
    return $row['amount'];
}

function takeItem($itemId) {
    $qr_item = mysql_query("SELECT * FROM item WHERE id = ".$itemId);
    $items = array();
    while ($item = mysql_fetch_array($qr_item)) {
        $items[] = $item;
    }
    return $items;
}

function updateAmountInProfile($itemId, $userId, $count){
    mysql_query('UPDATE user_item SET amount = '.$count.' WHERE user_id = '.$userId.' AND item_id = '.$itemId);
}

function addItemToProfile($itemId, $userId) {
    mysql_query('UPDATE user_item SET item_id = '.$itemId.' WHERE user_id = '.$userId);
}

function checkItemInProfile($itemId, $userId) {
    $result = mysql_query("SELECT amount FROM user_item WHERE user_id = ".$userId." AND item_id = ".$itemId);
    $row = mysql_fetch_assoc($result);
    return $row['item_id'];
}

function createNewOrder($userId) {
    $totalSum = 0;
    mysql_query("INSERT INTO orders (user_id, total_sum, status) VALUES ($userId, $totalSum, '".ORDER_STATUS_NEW."')");
    $orderId = mysql_insert_id();
    return $orderId;
}

function orderCancel($orderId) {
    mysql_query('UPDATE orders SET status = "'.ORDER_STATUS_CANCELED.'" WHERE id = '.$orderId);
}

function orderPayed($orderId) {
    mysql_query('UPDATE orders SET status = "'.ORDER_STATUS_PAYED.'" WHERE id = '.$orderId);
}

function orderFail($orderId) {
    mysql_query('UPDATE orders SET status = "'.ORDER_STATUS_FAILED.'" WHERE id = '.$orderId);
}

function takeAllOrders($userId) {
    $qrOrders = mysql_query('SELECT * FROM orders WHERE user_id = '.$userId);
    $orders = array();
    while ($order = mysql_fetch_array($qrOrders)) {
        $orders[] = $order;
    }
    return $orders;
}

function takeAllUserItems($userId) {
    $qrOrders = mysql_query('SELECT * FROM user_item WHERE user_id = '.$userId);
    $items = array();
    while ($item = mysql_fetch_array($qrOrders)) {
        $items[] = $item;
    }
    return $items;
}

function getOrderByUserId($userId) {
    $result = mysql_query('SELECT id FROM orders WHERE user_id = '.$userId.' AND status = "'.ORDER_STATUS_NEW.'"');
    $row = mysql_fetch_assoc($result);
    return $row['id'];
}

function addItemsToDB($itemId, $count, $orderId, $totalSum) {
    mysql_query("UPDATE orders SET total_sum = ".$totalSum." WHERE id = ".$orderId);
    mysql_query("INSERT INTO order_item (order_id, item_id, amount) VALUES ($orderId, $itemId, $count)");
}

/**
 * @param integer $itemId
 *
 * @return integer
 */
function takeItemPrice($itemId) {
    $result = mysql_query("SELECT price FROM item WHERE id = ".$itemId);
    $row = mysql_fetch_assoc($result);
    return $row['price'];
}

function takeTotalSumWithId($orderId) {
    $result = mysql_query("SELECT total_sum FROM orders WHERE id = ".$orderId);
    $row = mysql_fetch_assoc($result);
    return $row['total_sum'];
}

function takeTotalSum($items) {
    $totalSum = 0;
    foreach ($items as $key => $value) {
        $itemId = $key;
        $price = takeItemPrice($itemId);
        $totalSum += $value * $price;
    }
    return $totalSum;
}

function addNewAddress($address, $user_id) {
    $order_id = getOrderByUserId($user_id);
    mysql_query('UPDATE orders SET address = "'.$address.'" where id = '.$order_id);
}

function takeItemsIds($orderId) {
    $qrItemsIds = mysql_query("SELECT item_id FROM order_item where order_id = ".$orderId);
    $items = array();
    while ($item = mysql_fetch_array($qrItemsIds)) {
        $items[] = $item;
    }
    return $items;
}

/*function selectedCount($itemId, $userId) {
    $order_ids = getOrderByUserId($userId);
    $order_id = $order_ids[0][0];
    $qr_count = mysql_query("SELECT amount FROM order_item WHERE order_id = ".$order_id." AND item_id = ".$itemId);
    $counts = array();
    while ($count = mysql_fetch_array($qr_count)) {
        $counts[] = $count;
    }
    return $counts;
}*/

/*function change_count($new_count, $item_id, $user_id) {
    $order_ids = getOrderByUserId($user_id);
    $order_id = $order_ids[0][0];
    $qr_order = mysql_query("SELECT amount FROM order_item WHERE item_id = ".$item_id." and order_id = ".$order_id);
    $old_counts = array();
    while ($old_count = mysql_fetch_array($qr_order)) {
        $old_counts[] = $old_count;
    }
    $old_count_all = $old_counts[0][0];
    $qr_item_price = mysql_query("SELECT price FROM item WHERE id = ".$item_id);
    $item_prices = array();
    while ($item_price = mysql_fetch_array($qr_item_price)) {
        $item_prices[] = $item_price;
    }
    $price = $item_prices[0][0];
    if($new_count < $old_count_all) {
        $change_count = $old_count-$new_count;
        $new_sum = $change_count*$price;
        $qr_change_sum = mysql_query("UPDATE orders SET total_sum = total_sum - ".$new_sum);
    }elseif($new_count > $old_count_all) {
        $change_count = $new_count-$old_count;
        $new_sum = $change_count*$price;
        $qr_change_sum = mysql_query("UPDATE orders SET total_sum = total_sum + ".$new_sum);
    }
    $qr_change_count = mysql_query("UPDATE order_item SET amount = ".$new_count);
    return $qr_change_count;
}*/

/*function delete_item($item_id, $user_id) {
    $order_ids = getOrderByUserId($user_id);
    $order_id = $order_ids[0][0];
    $qr_total_sum = mysql_query("DELETE * FROM order_item WHERE item_id = ".$item_id." and order_id = ".$order_id);
}*/
