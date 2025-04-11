<?php
include_once "../common-functions.php";
connectDB();
if (isset($_SESSION['visit_id']) && isset($_SESSION['customer_id'])) {
    $sql = "SELECT visit_finished FROM customer_visit WHERE visit_id = " . $_SESSION['visit_id'];
    if ($result = mysqli_query($con, $sql)) {
        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            if ($row['visit_finished'] == 1) {
                session_destroy();
                echo "destoryed session";
            }
        }
    }
}

closeDB();