<?php
include_once "../common-functions.php";
connectDB();
$queryCancellation = "DELETE FROM customer_visit WHERE visit_id = {$_SESSION['visit_id']}";
if(mysqli_query($con, $queryCancellation)){
    echo "Cancelled";
    session_destroy();
}else{
    echo mysqli_error($con);
}
closeDB();