<?php
include_once "../common-functions.php";
connectDB();

if (isset($_POST['orderId']) && $_POST['type'] == "prep") {
    $queryUpdateStatus = "UPDATE orders SET order_status = 1 WHERE order_id = {$_POST['orderId']}";
    if (mysqli_query($con, $queryUpdateStatus)) {
        echo "updated to prep";
    } else {
        echo "failed update to prep";
    }
}
if (isset($_POST['orderId']) && $_POST['type'] == "completed") {
    $queryUpdateStatus = "UPDATE orders SET order_status = 2 WHERE order_id = {$_POST['orderId']}";
    if (mysqli_query($con, $queryUpdateStatus)) {
        echo "updated to completed";
    } else {
        echo "failed update to completed";
    }
}
if (isset($_POST['orderId']) && $_POST['type'] == "queue") {
    $queryUpdateStatus = "UPDATE orders SET order_status = 0 WHERE order_id = {$_POST['orderId']}";
    if (mysqli_query($con, $queryUpdateStatus)) {
        echo "updated to queue";
    } else {
        echo "failed update to queue";
    }
}
if (isset($_POST['orderId']) && $_POST['type'] == "done") {
    $queryUpdateStatus = "UPDATE orders SET payment_status = 1 WHERE order_id = {$_POST['orderId']}";
    if (mysqli_query($con, $queryUpdateStatus)) {
        echo "updated to done";
    } else {
        echo "failed update to done";
    }
}
if (isset($_POST['orderId']) && $_POST['type'] == "pending") {
    $queryUpdateStatus = "UPDATE orders SET payment_status = 0 WHERE order_id = {$_POST['orderId']}";
    if (mysqli_query($con, $queryUpdateStatus)) {
        echo "updated to pending";
    } else {
        echo "failed update to pending";
    }
}

closeDB();
?>