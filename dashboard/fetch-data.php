<?php
include_once "../common-functions.php";
connectDB();
$response = array();
if (isset($_POST['unpaidOrders'])) {
    $sql = "SELECT 
                COUNT(*) as count
            FROM 
                orders
            WHERE 
                payment_status = 0;
            ";

    if ($result = mysqli_query($con, $sql)) {
        if ($result->num_rows == 1) {
            $row = $result->fetch_assoc();
            $response['unpaidOrders'] = $row['count'];
        }
    } else {
        $response['unpaidOrders'] = 0;
    }
}

if (isset($_POST['pendingOrders'])) {
    $sql = "SELECT 
                COUNT(*) as count
            FROM 
                orders
            WHERE 
                order_status = 0;
            ";

    if ($result = mysqli_query($con, $sql)) {
        if ($result->num_rows == 1) {
            $row = $result->fetch_assoc();
            $response['pendingOrders'] = $row['count'];
        }
    } else {
        $response['pendingOrders'] = 0;
    }
}

if (isset($_POST['availableTable'])) {
    $sql = "SELECT count(*) as count FROM tables t LEFT JOIN table_allocated ta ON 
        t.table_id = ta.table_id LEFT JOIN customer_visit cv ON ta.visit_id = cv.visit_id 
        WHERE ta.visit_id IS NULL";

    if ($result = mysqli_query($con, $sql)) {
        if ($result->num_rows == 1) {
            $row = $result->fetch_assoc();
            $response['availableTable'] = $row['count'];
        }
    } else {
        $response['availableTable'] = 0;
    }
}

if (isset($_POST['occupiedTable'])) {
    $sql = "SELECT count(*) as count FROM tables t LEFT JOIN table_allocated ta ON 
    t.table_id = ta.table_id LEFT JOIN customer_visit cv ON ta.visit_id = cv.visit_id 
    WHERE ta.visit_id IS NOT NULL AND have_seated = 1";

    if ($result = mysqli_query($con, $sql)) {
        if ($result->num_rows == 1) {
            $row = $result->fetch_assoc();
            $response['occupiedTable'] = $row['count'];
        }
    } else {
        $response['occupiedTable'] = 0;
    }
}

if (isset($_POST['monthlyRevenue'])) {
    $sql = "SELECT 
    SUM(quantity * price_per_unit) AS monthly_revenue
    FROM 
        order_items
    JOIN 
        orders ON order_items.order_id = orders.order_id
    WHERE payment_status = 1 AND order_status = 2 AND 
    MONTH(orders.order_datetime) = MONTH(CURRENT_DATE())
    AND YEAR(orders.order_datetime) = YEAR(CURRENT_DATE())";

    if ($result = mysqli_query($con, $sql)) {
        if ($result->num_rows == 1) {
            $row = $result->fetch_assoc();
            $response['monthlyRevenue'] = "₹" . $row['monthly_revenue'];
        }
    } else {
        $response['monthlyRevenue'] = "₹0";
    }
}
echo json_encode($response);

closeDB();
