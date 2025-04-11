<?php
session_start();

$con = null;

if (
    !isset($_SESSION['usertype']) && 
    !(
        $_SERVER['PHP_SELF'] == "/RMS/login/login.php" || 
        $_SERVER['PHP_SELF'] == "/RMS/registration/registration.php"
    ) && 
    strpos($_SERVER['PHP_SELF'], "/RMS/customer/") === false
) {
    header("location:../login/login.php");
}

// echo $_SERVER['PHP_SELF'];

function connectDB()
{
    $servername = "localhost";
    $username = "root";
    $password = "";
    $database = "dinewise";
    // Create connection
    global $con;
    $con = new mysqli($servername, $username, $password, $database);

    // Check connection
    if ($con->connect_error) {
        die("Connection failed: " . $con->connect_error);
    }
    // echo "Connected successfully";

}

function closeDB()
{
    global $con;
    $con->close();
}


function getCustomerDetailsById($custId)
{
    global $con;

    $queryGetCustomer = "SELECT cust_id, cust_name, cust_contactno FROM customer WHERE cust_id = $custId";
    if ($result = mysqli_query($con, $queryGetCustomer)) {
        if (!empty($result) && $result->num_rows > 0) {
            return $result->fetch_assoc();
        } else {
            return null;
        }
    }
    return null;
}

function getCustomerDetailsByVisitId($visitId)
{
    global $con;

    $queryGetCustomer = "SELECT c.cust_id, cust_name, cust_contactno, visit_id, 
    no_of_person, visiting_datetime, visit_finished, have_seated FROM customer c, customer_visit cv 
    WHERE c.cust_id = cv.cust_id AND visit_id = $visitId";
    if ($result = mysqli_query($con, $queryGetCustomer)) {
        if (!empty($result) && $result->num_rows > 0) {
            return $result->fetch_assoc();
        } else {
            return null;
        }
    }
    return null;
}
?>