<?php
// It will store data coming from view_tables.php

// form 4 fields 
// tableNo
// tableSeatCount
// tableLocation
// tableImage

include_once "../common-functions.php";

if ($_SERVER['REQUEST_METHOD'] == "POST") {

    $tableImageUrl = null;
    connectDB();

    $tableNo = mysqli_escape_string($con, htmlspecialchars(trim($_POST['tableNo'])));
    $tableSeatCount = mysqli_escape_string($con, htmlspecialchars(trim($_POST['tableSeatCount'])));
    $tableLocation = mysqli_escape_string($con, htmlspecialchars(trim($_POST['tableLocation'])));

    // table fields
    // 	table_id	table_number	table_seating	table_location	table_image	table_occupied	


    $directory = "table-images";
    if (!file_exists($directory)) {
        mkdir($directory, 0777, true); // Create directory with full permissions
    }

    // Check if file was uploaded without errors
    if (isset($_FILES["tableImage"]) && $_FILES["tableImage"]["error"] == 0) {
        $allowed_types = array("image/jpeg", "image/png", "image/gif");
        $file_type = $_FILES["tableImage"]["type"];

        // Check if the file type is allowed
        if (in_array($file_type, $allowed_types)) {
            $upload_dir = "table-images/";
            $upload_file = $upload_dir . $tableNo;

            $tableImageUrl = $upload_file;

            // Attempt to move the uploaded file to the specified directory
            if (move_uploaded_file($_FILES["tableImage"]["tmp_name"], $upload_file)) {
                echo "File uploaded successfully.";
            } else {
                echo "Error uploading file.";
            }
        } else {
            echo "Invalid file type. Allowed types are JPG, PNG, and GIF.";
        }
    } else {
        // echo "Error uploading file.";
    }

    $sql = "INSERT INTO tables (table_number, table_seats, table_location) values (?,?,?)";
    $stmt = mysqli_prepare($con, $sql);
    mysqli_stmt_bind_param($stmt, "iis", $tableNo, $tableSeatCount, $tableLocation);

    if (mysqli_stmt_execute($stmt)) {
        echo "Inserted";
    } else {
        echo "Error: " . mysqli_stmt_error($stmt);
    }

    mysqli_stmt_close($stmt);
    closeDB();
}