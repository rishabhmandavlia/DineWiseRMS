<?php
include_once "../common-functions.php";
connectDB();
$tablesQuery = "SELECT t.table_id, cv.visit_id, t.table_number, t.table_seats, t.table_location, t.table_image, cv.have_seated,
ta.table_allocation_time
FROM tables t
LEFT JOIN table_allocated ta ON t.table_id = ta.table_id
LEFT JOIN customer_visit cv ON ta.visit_id = cv.visit_id ORDER BY t.table_id ASC";
$result = mysqli_query($con, $tablesQuery);
if (!empty($result) && $result->num_rows > 0) {
    $i = 1;
    // echo "<div class='row'>"; // 20
    while ($row = mysqli_fetch_assoc($result)) {
        // if ($i % 2 == 1) {
        //     echo "<div class='row pt-4 pb-4'>"; //13
        echo "<div class='col-md-6 col-sm-12 col-mod table-container-main py-2'>"; //11
        // }
        echo "<div class='py-1 d-flex justify-content-left align-items-center deletable' data-tableid='{$row['table_id']}'>"; //12
        echo "<div class='table-container'>"; //1

        if ($row['table_seats'] % 2 == 1) {
            if ($row['have_seated'] == true) {
                echo "<div class='one-chair'>
                <div class='chair' style='background-color:#ff7929'></div>
             </div>";
            } else if ($row['visit_id'] != false && $row['have_seated'] == false) {
                echo "<div class='one-chair'>
                <div class='chair' style='background-color:#328bff'></div>
             </div>";
            } else if ($row['visit_id'] == null && $row['have_seated'] == null) {
                echo "<div class='one-chair'>
                <div class='chair' style='background-color:#28a745'></div>
             </div>";
            }
        }

        echo "<div class='table-outline'>"; //2

        echo " <div class='chair-row-top'>"; // 4
        $seats = $row['table_seats'] / 2;
        for ($seat = 0; $seat < $seats; $seat++) {
            if ($row['have_seated'] == true) {
                echo "<div class='chair' style='background-color:#ff7929'></div>";
            } else if ($row['visit_id'] != false && $row['have_seated'] == false) {
                echo "<div class='chair' style='background-color:#328bff'></div>";
            } else if ($row['visit_id'] == null && $row['have_seated'] == null) {
                echo "<div class='chair' style='background-color:#28a745'></div>";
            }
        }
        echo "</div>"; // 4

        if ($row['have_seated'] == true) {
            echo "<div class='table-row d-flex align-items-center justify-content-center' style='color:rgb(255,255,255,0.60); background-color:#ff7929'><span style='font-size:25px;'>T{$row['table_number']}</span></div>"; // Orange for occupied
        } else if ($row['visit_id'] != null && $row['have_seated'] == false) {
            echo "<div class='table-row d-flex align-items-center justify-content-center' style='color:rgb(255,255,255,0.60); background-color:#328bff'><span style='font-size:25px;'>T{$row['table_number']}</span></div>"; // Yellow for reserved
        } else if ($row['visit_id'] == null && $row['have_seated'] == null) {
            echo "<div class='table-row d-flex align-items-center justify-content-center' style='color:rgb(255,255,255,0.60); background-color:#28a745'><span style='font-size:25px;'>T{$row['table_number']}</span></div>"; // Green for unoccupied
        }

        echo "<div class='chair-row-bottom'>"; //3
        for ($seat = 0; $seat < $seats; $seat++) {
            if ($row['have_seated'] == true) {
                echo "<div class='chair' style='background-color:#ff7929'></div>";
            } else if ($row['visit_id'] != false && $row['have_seated'] == false) {
                echo "<div class='chair' style='background-color:#328bff'></div>";
            } else if ($row['visit_id'] == null && $row['have_seated'] == null) {
                echo "<div class='chair' style='background-color:#28a745'></div>";
            }
        }
        echo "</div>"; // 3

        echo "</div>"; //2  

        echo "</div>"; //1

        // echo "<div class=''>"; // 21

        if ($row['visit_id'] == null && $row['have_seated'] == null) {
            // 14
            echo "<div class='table-details pl-2 py-3'>
                <h5 class='table-num'> Table No. {$row['table_number']}</h5>     
                <h5 class='text-success'>Unoccupied</h5>";
        } else {
            // 14
            date_default_timezone_set('Asia/Kolkata');
            $start_date = strtotime(date("Y-m-d h:i:s A", strtotime($row['table_allocation_time'])));
            $end_date = strtotime("now");

            // Calculate the interval in seconds
            $interval = $end_date - $start_date;

            // echo "$interval = " . date("Y-m-d h:i:s A", $end_date) . " - " . date("Y-m-d h:i:s A", $start_date);

            // Convert the interval to days, hours, minutes, and seconds
            $days = floor($interval / (60 * 60 * 24));
            $hours = floor(($interval - ($days * 60 * 60 * 24)) / (60 * 60));
            $minutes = floor(($interval - ($days * 60 * 60 * 24) - ($hours * 60 * 60)) / 60);
            $seconds = $interval - ($days * 60 * 60 * 24) - ($hours * 60 * 60) - ($minutes * 60);

            // Print the interval
            if ($hours == 0 && $minutes == 0 && $seconds == 0) {
                $timeRemain = "0 Seconds";
            } else {
                $timeRemain = ($days != 0) ? $days . " days " : "";
                $timeRemain .= ($hours != 0) ? $hours . "h " : "";
                $timeRemain .= ($minutes != 0) ? $minutes . "min " : "";
                $timeRemain .= $seconds . 'sec';
            }
            
            if ($row['visit_id'] != false && $row['have_seated'] == false) {
                echo "<div class='table-details pl-2 py-3'>
                <h6 class='table-num'> Table No. {$row['table_number']}</h6>
                <h5 style='color:#328bff;'>Reserved</h5>
                <span>Occupancy time: <span id='time-taken'>$timeRemain</span></span>
                ";
            } else if ($row['have_seated'] == true) {
                echo "<div class='table-details pl-2 py-3'>
                <h6 class='table-num'> Table No. {$row['table_number']}</h6>
                <h5 style='color:#ff7929;'>Occupied</h5>
                <span>Occupancy time: <span id='time-taken'>$timeRemain</span></span>
                ";
            }
        }


        $queryCheckAllocatedToSomeone = "SELECT table_id, visit_id, table_allocation_time FROM table_allocated WHERE table_id = {$row['table_id']}";

        if ($result1 = mysqli_query($con, $queryCheckAllocatedToSomeone)) {
            if (!empty($result1) && $result1->num_rows > 0) {
                echo "<h6 class='pt-1'>Allocated to:</h6>";
                $custCount = 1;
                while ($row1 = $result1->fetch_assoc()) {
                    $customerDetail = getCustomerDetailsByVisitId($row1['visit_id']);
                    echo "$custCount. <span>{$customerDetail['cust_name']}</span><br>";
                    $custCount++;
                }
            }
        } else {
            // Query failed to run
            echo "Query failed to run";
        }

        echo "</div>"; //14
        // echo "</div>"; //21
        echo "</div>"; //11
        echo "</div>"; //12

        // if ($i % 2 == 0) {
        //     echo "</div>"; //13
        // }
        $i++;
    }
    // echo "</div>"; //20

} else {
    echo "<center><h2>No tables are added</h2></center>";
}

closeDB();