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
            o.payment_status = 0;
";
if ($result = mysqli_query($con, $sql)) {
    if (!empty($result) && $result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "<tr role='row' class='odd table-light table-plus sorting_1 justify-content-left align-items-right'
                                            tabindex='0'>";

            echo "<td>{$row['cust_name']}</td>";
            echo "<td>{$row['cust_contactno']}</td>";
            echo "<td>{$row['order_datetime']}</td>";
            
            if ($row['order_status'] == 0) {
                echo "<td class='bg-warning rounded'><span class='text-white'>Pending</span></td>";
            } else if ($row['order_status'] == 1) {
                echo "<td class='bg-info rounded'><span class='text-white'>Preparation</span></td>";
            } else if ($row['order_status'] == 2) {
                echo "<td class='bg-success rounded'><span class='text-white'>Completed</span></td>";
            }
            echo "</tr>";
        }
    } else {
        echo "<tr><td class='table-light' colspan='4'>No payments are pending</td></tr>";
    }
}

closeDB();