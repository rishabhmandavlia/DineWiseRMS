<?php
include_once "../common-functions.php";
connectDB();
$checkUserExists = "SELECT cust_id, cust_name, cust_contactno FROM customer WHERE cust_contactno = ?";
$stmt = $con->prepare($checkUserExists);
$stmt->bind_param("s", $_POST['contactNumber']);
$stmt->execute();
$result = $stmt->get_result();
if ($row = $result->fetch_assoc()) {
    $row['status'] = "found";
    echo json_encode($row);
}else{
    $response['status'] = "not found";
    echo json_encode($response);
}

closeDB();




