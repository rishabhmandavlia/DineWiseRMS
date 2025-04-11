<?php
include_once "../common-functions.php";
connectDB();
$queryDeleteTable = "DELETE FROM tables WHERE table_id = {$_POST['tableId']}";

if ($con->query($queryDeleteTable) === TRUE) {
    echo "table deleted";
} else {
    echo "Error: " . $queryDeleteTable . "<br>" . $con->error;
}

closeDB();