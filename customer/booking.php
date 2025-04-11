<?php
include_once "../common-functions.php";
connectDB();
$contactNo = mysqli_escape_string($con, htmlspecialchars(trim($_POST['contactNo'])));
$fullName = mysqli_escape_string($con, htmlspecialchars(trim($_POST['fullName'])));
$noOfPerson = mysqli_escape_string($con, htmlspecialchars(trim($_POST['noOfPerson'])));

$_SESSION['contact_no'] = $contactNo;
$_SESSION['full_name'] = $fullName;
$_SESSION['no_of_person'] = $noOfPerson;

$sqlGetMaxTableSize = "SELECT MAX(table_seats) as count FROM tables";
if ($tableSizeResult = mysqli_query($con, $sqlGetMaxTableSize)) {
    if (!empty($tableSizeResult) && $tableSizeResult->num_rows > 0) {
        $tableSize = $tableSizeResult->fetch_assoc();
        $tableSize = $tableSize['count'];
    }
} else {
    $tableSize = 15;
}


if (!isset($contactNo) || empty($contactNo) || !preg_match("/^\d{10}$/", $contactNo)) {
    // Invalid contact number
    $_SESSION['error'] = "Invalid contact number. Please enter a 10-digit number.";
    header("Location: table-booking.php");
    exit;
}

if (!isset($fullName) || empty($fullName)) {
    // Full name is empty
    $_SESSION['error'] = "Full name cannot be empty.";
    header("Location: table-booking.php");
    exit;
}

if (!isset($noOfPerson) || empty($noOfPerson) || !is_numeric($noOfPerson) || $noOfPerson <= 0 && $tableSize >= $noOfPerson) {
    // Invalid number of persons
    $_SESSION['error'] = "Invalid number of persons. Please enter a valid number.";
    header("Location: table-booking.php");
    exit;
}

if (isset($_POST['rememberMe'])) {
    setcookie("contact_no", $contactNo, time() + 60 * 60 * 24 * 7);
    setcookie("full_name", $fullName, time() + 60 * 60 * 24 * 7);
} else {
    setcookie("contact_no", "", time() - 60 * 60);
    setcookie("full_name", "", time() - 60 * 60);
}

// After getting user's request first we need to add data to the database with other request to process

// We need to find out which tables are unoccupied
// Add them to an array

$customerId = null;

$sql = "SELECT cust_id from customer WHERE cust_contactno = '$contactNo'";
$result = mysqli_query($con, $sql);
if (!empty($result) && $result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $customerId = $row['cust_id'];
    $_SESSION['customer_id'] = $customerId;
} else {
    $insertNewCustomer = "INSERT INTO customer (cust_name, cust_contactno) VALUES (?,?)";
    $stmt = mysqli_prepare($con, $insertNewCustomer);
    mysqli_stmt_bind_param($stmt, "ss", $fullName, $contactNo);

    if ($result = mysqli_stmt_execute($stmt)) {
        echo "Customer Inserted<br>";
    } else {
        echo "Error: " . mysqli_stmt_error($stmt);
    }

    $customerId = mysqli_insert_id($con);

    $_SESSION['customer_id'] = $customerId;

    mysqli_stmt_close($stmt);
}


// Creating a visit

// table structure
//visit_id	cust_id	no_of_person	visiting_datetime	visit_finished	have_seated	

// First check that previous visit is completed or not
$queryCheckVisit = "SELECT * FROM customer_visit WHERE DATE(visiting_datetime) = CURDATE() AND visit_finished = 0 AND cust_id = {$customerId}";
if ($visitExist = mysqli_query($con, $queryCheckVisit)) {
    if (!empty($visitExist) && $visitExist->num_rows > 0) {
        // Please finish previous visit
        // echo "Please finish previous visit";
        $_SESSION['visit_id'] = $visitExist->fetch_assoc()['visit_id'];
    } else {
        $insertAVisit = "INSERT INTO customer_visit (cust_id, no_of_person, visiting_datetime) VALUES ($customerId, $noOfPerson, NOW())";
        if (mysqli_query($con, $insertAVisit)) {
            echo "Visit Inserted<br>";
            $_SESSION['visit_id'] = mysqli_insert_id($con);
        } else {
            echo "Error in visit inserted<br>";
            echo "Error: " . mysqli_error($con);
        }
    }
}


header("location:view-booking.php");
closeDB();
