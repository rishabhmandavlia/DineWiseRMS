<?php
include_once "../common-functions.php";
connectDB();


$sql = "SELECT 
            o.order_id,
            o.order_datetime,
            o.order_status,
            o.payment_status,
            c.cust_name,
            c.cust_contactno
        FROM 
            orders o
        JOIN 
            customer c ON o.cust_id = c.cust_id
        WHERE 
            o.order_status = 0;
";
if ($result = mysqli_query($con, $sql)) {
    if (!empty($result) && $result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "<tr role='row' class='odd table-light table-plus sorting_1 justify-content-left align-items-right'
                                            tabindex='0'>";
           
            echo "<td>{$row['cust_name']}</td>";
            echo "<td>{$row['cust_contactno']}</td>";
            echo "<td>{$row['order_datetime']}</td>";
            echo "<td><a href='../order/view-order.php?searchOrder={$row['order_id']}'><button class='btn btn-primary' data-order-id='{$row['order_id']}'>Go to order</button></a></td>";
            echo "</tr>";
        }
    } else {
        echo "<tr><td class='table-light' colspan='4'>No orders are pending</td></tr>";
    }
}

closeDB();