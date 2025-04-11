<?php
include_once "../common-functions.php";
connectDB();
$sql = "SELECT cv.visit_id, cust_name, cust_contactno, no_of_person FROM customer c LEFT JOIN customer_visit cv ON c.cust_id = cv.cust_id 
                                    LEFT JOIN table_allocated ta ON ta.visit_id = cv.visit_id WHERE cv.visit_id IS NOT NULL 
                                    AND ta.table_id IS NULL AND DATE(visiting_datetime) = CURDATE() AND cv.visit_finished = 0";
if ($result = mysqli_query($con, $sql)) {
    if (!empty($result) && $result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "<tr role='row' class='odd table-light table-plus sorting_1 justify-content-left align-items-right'
                                            tabindex='0'>";
            echo "<td class='table-plus sorting_1 justify-content-left align-items-right'
                                                tabindex='0'>{$row['visit_id']}</td>";
            echo "<td>{$row['cust_name']}</td>";
            echo "<td>{$row['cust_contactno']}</td>";
            echo "<td>{$row['no_of_person']} person</td>";
            echo "</tr>";
        }
    } else {
        echo "<tr><td class='table-light' colspan='4'>No bookings for today</td></tr>";
    }
}

closeDB();