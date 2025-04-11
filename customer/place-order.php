<?php
include_once "../common-functions.php";
connectDB();
$itemIds = $_POST['itemIds'];
$itemQuantities = $_POST['itemQuantities'];

$orderStatus = true;
$response = array();

function getPrice($itemId)
{
    global $con;
    $query = "SELECT price FROM menu_item WHERE item_id = ?";
    $stmt = $con->prepare($query);
    if (!$stmt) {
        $response['message'] = "Error at get item price 1";
        return false;
    }
    $stmt->bind_param('i', $itemId);
    if (!$stmt->execute()) {
        $response['message'] = "Error at get item price 2";
        return false;
    }
    $result = $stmt->get_result();
    if (!$result) {
        $response['message'] = "Error at get item price 3";
        return false;
    }
    $row = $result->fetch_assoc();
    if (!$row) {
        $response['message'] = "Error at get item price 4";
        return false;
    }
    $price = $row['price'];
    // executed get price successfully
    return $price;
}

if (isset($itemIds) && isset($itemQuantities) && isset($_SESSION['customer_id'])) {
    $customerId = $_SESSION['customer_id'];

    $queryCreateNewOrder = "INSERT INTO orders (cust_id, order_datetime) VALUES (?, NOW())";
    $stmt = $con->prepare($queryCreateNewOrder);
    $stmt->bind_param('i', $customerId);
    if ($stmt->execute()) {
        // Order created successfully
        $orderId = $con->insert_id;
        $queryAddItemToOrder = "INSERT INTO order_items (item_id, order_id, quantity, price_per_unit) 
        VALUES (?, ?, ?, ?)";
        $stmt1 = $con->prepare($queryAddItemToOrder);
        for ($i = 0; $i < count($itemIds); $i++) {

            $price = getPrice($itemIds[$i]);
            if ($price != false) {
                $stmt1->bind_param('iiii', $itemIds[$i], $orderId, $itemQuantities[$i], $price);

                if (!$stmt1->execute()) {
                    // Order item not added
                    $orderStatus = false;
                }
            } else {
                $response['message'] = "Error at get item price 5";
                $response['status'] = false;
                exit();
            }
        }
    } else {
        $orderStatus = false;
    }
    $stmt->close();
    $stmt1->close();

    if ($orderStatus == true) {
        $response['message'] = "Order Placed Successfully";
        
        $response['status'] = true;
    } else {
        $response['message'] = "Order is not placed";
        
        $response['status'] = false;
    }
} else {
    $response['message'] = "Data not received";
    
    $response['status'] = false;
}
closeDB();
echo json_encode($response);
