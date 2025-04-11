<?php

// Table tables structure
// table_id	table_number table_seats table_location	table_image	currently_sitting	
// cust_id	cust_name cust_contactno
// visit_id	cust_id no_of_person visiting_datetime visit_finished have_seated
include_once "common-functions.php";
connectDB();

// function deallocateTables()
// {
//     echo "Started deallocation";
//     global $con;
//     $queryForGettingTableForDeallocation = "SELECT visit_id FROM customer_visit cv WHERE visiting_datetime <= DATE_SUB(NOW(), INTERVAL 10 MINUTE) AND have_seated = 0 AND visit_finished = 0";
//     if ($result = mysqli_query($con, $queryForGettingTableForDeallocation)) {
//         if (!empty($result) && $result->num_rows > 0) {
//             while ($row = $result->fetch_assoc()) {
//                 $queryUpdateStatusToFinished = "UPDATE customer_visit cv SET visit_finished = 1 WHERE visit_id = {$row['visit_id']}";
//                 if (mysqli_query($con, $queryUpdateStatusToFinished)) {
//                     $queryDeallocate = "DELETE FROM table_allocated WHERE visit_id = {$row['visit_id']}";
//                     if(mysqli_query($con, $queryDeallocate)){

//                     }else {
//                     echo "Failed to run query for deallocation";
//                 }
//                 }else {
//                     echo "Failed to run query for updating tables";
//                 }
//             }
//         } else {
//             echo "No table for deallocation";
//         }
//     } else {
//         echo "Failed to run query for fetching tables";
//     }
// }
function getCustomersForToday()
{
    global $con;
    $queryGetVisitsForToday = "SELECT customer.cust_id AS custid, cv.visit_id, 
    cv.visiting_datetime, cv.no_of_person 
    FROM customer 
    JOIN customer_visit AS cv ON customer.cust_id = cv.cust_id 
    LEFT JOIN table_allocated ta ON cv.visit_id = ta.visit_id 
    WHERE DATE(cv.visiting_datetime) = CURDATE() 
    AND cv.have_seated = 0 
    AND cv.visit_finished = 0 
    AND ta.visit_id IS NULL 
    ORDER BY cv.visiting_datetime ASC";

    if ($result = mysqli_query($con, $queryGetVisitsForToday)) {
        // Get list of bookings of current day
        if (!empty($result) && $result->num_rows > 0) {
            return $result;
        }
    }
    return false;
}

function getTableForAllocation()
{
    global $con;

    $queryFindTables = "SELECT t.table_id, t.table_seats FROM tables t
LEFT JOIN table_allocated ta ON t.table_id = ta.table_id
WHERE ta.table_id IS NULL ORDER BY table_seats ASC";

    if ($result1 = mysqli_query($con, $queryFindTables)) { // Finding table to assign per booking
        if (!empty($result1) && $result1->num_rows > 0) {
            return $result1;
        }
    }
    return false;
}

function assignTableToCustomer($visitId, $tableId)
{
    global $con;
    $assignTableToCustomerQuery = "INSERT INTO table_allocated (visit_id, table_id, table_allocation_time) 
    VALUES ($visitId, $tableId, NOW())";
    if (mysqli_query($con, $assignTableToCustomerQuery)) {

    } else {
        exit("Some error occured at assigning of table" . mysqli_error($con));
    }
}

// deallocateTables();

if ($customers = getCustomersForToday()) {

    while ($customer = $customers->fetch_assoc()) {

        if ($tables = getTableForAllocation()) {

            while ($table = $tables->fetch_assoc()) {

                if ($table['table_seats'] >= $customer['no_of_person']) {
                    assignTableToCustomer($customer['visit_id'], $table['table_id']);
                    break;
                }
            }
        } else {
            // No table are found
            closeDB();

            exit("No tables found");
        }
    }
} else {
    // No customers found
    closeDB();

    exit("No customers found");
}
closeDB();
?>