<?php
include_once "../common-functions.php";
connectDB();
$reserved = false;
$haveSeated = null;
$queryCheckTableReserved = "SELECT cv.visit_id, ta.table_id, have_seated FROM table_allocated ta, customer_visit cv WHERE 
cv.visit_id = ta.visit_id AND cv.cust_id = {$_SESSION['customer_id']}";
if ($result = mysqli_query($con, $queryCheckTableReserved)) {
    if (!empty($result) && $result->num_rows > 0) {
        $reserved = true;
        $haveSeated = $result->fetch_assoc()['have_seated'];
    }
}



if ($reserved && $haveSeated == true) {

    ?>
    <h5 class="section-title ff-secondary text-start text-primary fw-normal">Booking Status</h5>
    <h1 class="mb-4">Occupied</h1>
    <div class="container-fluid p-0" style="overflow-x:auto">
        <table class="table">
            <tr class="table-primary">
                <th>Tables</th>
                <th>Location</th>
            </tr>
            <?php
            // table_id, table_number, table_seats, table_location, table_image	
            $queryGetAllocatedTables = "SELECT visit_id, ta.table_id, table_number, table_location 
                    FROM table_allocated ta RIGHT JOIN tables t ON t.table_id = ta.table_id 
                    WHERE visit_id = {$_SESSION['visit_id']}";
            if ($tablesAllocated = mysqli_query($con, $queryGetAllocatedTables)) {
                if (!empty($tablesAllocated) && $tablesAllocated->num_rows > 0) {
                    while ($tables = $tablesAllocated->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td class='table-light' style='word-wrap: break-word;min-width: 100px;'>Table no. {$tables['table_number']}</td>";
                        echo "<td class='table-light' style='word-wrap: break-word;min-width: 250px;'>{$tables['table_location']}</td>";
                        echo "</tr>";
                    }
                }
            }
            ?>
        </table>
    </div>
    <p class="mb-4">Kindly indicate the table as available once you've completed your meal.</p>
    <!-- <p class="mb-4"></p> -->

    <div id="finish-booking" class="btn btn-success py-3 px-5 mt-2">Finish</div>
    <?php
} else if ($reserved && $haveSeated == false) {

    ?>
        <h5 class="section-title ff-secondary text-start text-primary fw-normal">Booking Status</h5>
        <h1 class="mb-4">Reserved</h1>
        <div class="container-fluid p-0" style="overflow-x:auto">
            <table class="table">
                <tr class="table-primary">
                    <th>Tables</th>
                    <th>Seats</th>
                    <th>Location</th>
                </tr>
                <?php
                // table_id, table_number, table_seats, table_location, table_image	
                $queryGetAllocatedTables = "SELECT visit_id, ta.table_id, table_number, table_location, table_seats 
                    FROM table_allocated ta RIGHT JOIN tables t ON t.table_id = ta.table_id 
                    WHERE visit_id = {$_SESSION['visit_id']}";
                if ($tablesAllocated = mysqli_query($con, $queryGetAllocatedTables)) {
                    if (!empty($tablesAllocated) && $tablesAllocated->num_rows > 0) {
                        while ($tables = $tablesAllocated->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td class='table-light' style='word-wrap: break-word;min-width: 100px;'>Table no. {$tables['table_number']}</td>";
                            echo "<td class='table-light' style='word-wrap: break-word;min-width: 100px;'>{$tables['table_seats']}</td>";
                            echo "<td class='table-light' style='word-wrap: break-word;min-width: 200px;'>{$tables['table_location']}</td>";
                            echo "</tr>";
                        }
                    }
                }
                ?>
            </table>
        </div>
        <p class="mb-4">Please confirm your seating once you have been seated at the table.</p>
        <p class="mb-4"><span class="text-primary">Note: </span>Please arrive no later than 10 minutes after your table is
            reserved, otherwise, your booking will be cancelled.</p>

        <!-- <p class="mb-4"></p> -->

        <div id="confirm-booking" class="btn btn-primary py-3 px-5 mt-2">Confirm</div>
        <div id="exit-booking" class="btn btn-danger py-3 px-5 mt-2">Cancel Booking</div>
    <?php
} else {
    ?>
        <h5 class="section-title ff-secondary text-start text-primary fw-normal">Booking Status</h5>
        <h1 class="mb-4">Waiting</h1>
        <p class="mb-4">Your patience is greatly appreciated</p>
        <p class="mb-4">We'll notify you the moment it becomes available.</p>
        <p class="mb-4"><span class="text-primary">Note: </span>Please arrive no later than 10 minutes after your table is
            reserved, otherwise, your booking will be cancelled.</p>

        <div id="exit-booking" class="btn btn-danger py-3 px-5 mt-2">Cancel Booking</div>
    <?php
}
closeDB();
?>