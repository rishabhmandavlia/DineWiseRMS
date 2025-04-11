<?php
include_once "../common-functions.php";
connectDB();
$sql = "SELECT visit_id FROM table_allocated WHERE table_id = '{$_POST['tableId']}'";
if ($result = mysqli_query($con, $sql)) {
    if (!empty($result) && $result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $sql = "UPDATE customer_visit SET have_seated = 0, visit_finished = 1 WHERE visit_id = {$row['visit_id']}";
            if (mysqli_query($con, $sql)) {
                $sql = "DELETE FROM table_allocated WHERE table_id = '{$_POST['tableId']}'";
                if (mysqli_query($con, $sql)) {
                    echo "deleted";
                } else {
                    echo "error";
                }
            }
        }
    }

}



closeDB();