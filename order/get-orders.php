<?php
include_once "../common-functions.php";
connectDB();

$queryGetOrder = "SELECT order_id, order_datetime, order_status, payment_status, 
cust_name, cust_contactno FROM orders o LEFT JOIN customer c ON o.cust_id = c.cust_id 
ORDER BY order_datetime DESC";
if ($result = mysqli_query($con, $queryGetOrder)) {
    if (!empty($result) && mysqli_num_rows($result) > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "<div class='card card-box my-2' data-order-id='{$row['order_id']}'>
            <div class='card-body'>
                <h5 class='mb-3 px-2 py-3 rounded text-white " . ($row['order_status'] == 0 ? 'active-yellow' : ($row['order_status'] == 1 ? 'active-blue' :
                    ($row['order_status'] == 2 ? 'active-green' : ''))) . "'>
                Order No. : " . date('Ymd', strtotime($row['order_datetime'])) . $row['order_id'] . "</h5>
                <div class='container-fluid order-container'>
                    <p class='font-weight-bold ml-2 my-1'>Customer Details</p>
                    <div class='row  ml-2'>
                        <div class='col-md-6 col-sm-12'>
                            <b>Name : </b>{$row['cust_name']}
                        </div>
                        <div class='col-md-6 col-sm-12'>
                            <b>Contact No. :</b> {$row['cust_contactno']}
                        </div>
                    </div>
                    <p class='font-weight-bold ml-2 mb-0'>Order Details</p>
                    <div class='row  ml-2'>
                        <div class='col-md-6 col-sm-12'>
                            <b>Date: </b> " . date('d M, Y H:i A', strtotime($row['order_datetime'])) . "
                        </div>
                    </div>
                    <div style='overflow-x: auto'>
                        <table class='table my-3'>
                            <tr class='table-warning text-dark'>
                                <th>Item</th>
                                <th>Quantity</th>
                                <th>Price/Unit</th>
                                <th>Sub-total</th>
                            </tr>";
            $totalAmount = 0;
            $queryGetOrderItems = "SELECT order_id,	oi.item_id, item_name, quantity, price_per_unit 
                            FROM order_items oi LEFT JOIN menu_item mi ON oi.item_id = mi.item_id 
                            WHERE order_id = {$row['order_id']}";
            // echo $queryGetOrderItems;
            if ($resultOrderItems = mysqli_query($con, $queryGetOrderItems)) {
                if (!empty($resultOrderItems) && $resultOrderItems->num_rows > 0) {
                    while ($item = $resultOrderItems->fetch_assoc()) {
                        echo "<tr><td>";
                        echo ($item['item_name'] != '') ? $item['item_name'] : "Removed item";
                        echo "</td>
                                <td>{$item['quantity']}</td>
                                <td>₹{$item['price_per_unit']}</td>
                                <td>₹" . $item['price_per_unit'] * $item['quantity'] . "</td>
                              </tr>";
                        $totalAmount += $item['price_per_unit'] * $item['quantity'];
                    }
                } else {
                    echo "<tr><td colspan='3'>No items found</td></tr>";
                }
            } else {
                echo "<tr>" . mysqli_error($con) . "</tr>";
            }
            echo "<tr class='table-warning text-dark'>
                    <th colspan='3'>Total Amount : </th>
                    <th colspan='1'>₹$totalAmount.00</th>
                  </tr>";
            echo "</table>
                    </div>
                </div>
                <div class='mx-2 my-1 row'>
                    <div class='col-md-6 col-sm-12'>
                        <p class='font-weight-bold mb-0'>Order Status</p>
                        <div class='d-flex align-items-center justify-content-left' data-order-id='{$row['order_id']}'>
                            <div class='px-1 py-2 queue status-cell border " . ($row['order_status'] == 0 ? 'active-yellow' : '') . "' style='border-top-left-radius: 5px; 
                            border-bottom-left-radius: 5px'>Queue</div>
                            <div class='px-1 py-2 prep status-cell border " . ($row['order_status'] == 1 ? 'active-blue' : '') . "' style=''>Preparation</div>
                            <div class='px-1 py-2 completed status-cell border " . ($row['order_status'] == 2 ? 'active-green' : '') . "' style='border-top-right-radius: 5px; 
                            border-bottom-right-radius: 5px'>Completed</div>
                        </div>
                    </div>
                    <div class='col-md-6 col-sm-12'>
                        <p class='font-weight-bold mb-0'>Payment Status</p>
                        <div class='d-flex align-items-center justify-content-left' data-order-id='{$row['order_id']}'>
                            <div class='px-1 py-2 pending status-cell border " . ($row['payment_status'] == 0 ? 'active-yellow' : '') . "' style='border-top-left-radius: 5px; 
                                    border-bottom-left-radius: 5px'>Pending</div>
                            <div class='px-1 py-2 done status-cell border " . ($row['payment_status'] == 1 ? 'active-green' : '') . "'
                                style='border-top-right-radius: 5px; border-bottom-right-radius: 5px'>
                                Done</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>";
        }
    }
}

closeDB();
?>