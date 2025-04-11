<?php
include_once "../common-functions.php";
connectDB();
if ($_POST['action'] == "seated") {

    $queryHaveSeatedUpdate = "UPDATE customer_visit SET have_seated = 1 WHERE visit_id = {$_SESSION['visit_id']}";
    if (mysqli_query($con, $queryHaveSeatedUpdate)) {
        echo "Seated Updated";
        $_SESSION['seated'] = true;
    } else {
        echo mysqli_error($con);
    }
}

if ($_POST['action'] == "finish") {
    $queryHaveSeatedUpdate = "UPDATE customer_visit SET have_seated = 0, visit_finished = 1 WHERE visit_id = {$_SESSION['visit_id']}";
    if (mysqli_query($con, $queryHaveSeatedUpdate)) {
        echo "Visit finished";
        $updateTablesAllocation = "DELETE FROM table_allocated WHERE visit_id = {$_SESSION['visit_id']}";
        if (mysqli_query($con, $updateTablesAllocation)) {
            // echo "<br>Table freed";
        }
        session_destroy();
    } else {    
        echo mysqli_error($con);
    }
}
closeDB();
?>