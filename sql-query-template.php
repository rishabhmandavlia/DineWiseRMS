<?php 
// Values to insert
$name = "John";
$email = "john@example.com";
$age = 30;

// SQL query
$sql = "INSERT INTO users (name, email, age) VALUES ('$name', '$email', '$age')";

if ($con->query($sql) === TRUE) {
  echo "New record created successfully";
} else {
  echo "Error: " . $sql . "<br>" . $con->error;
}



// Prepared statement

// Prepare and bind statement
$stmt = $con->prepare("INSERT INTO users (name, email, age) VALUES (?, ?, ?)");
$stmt->bind_param("ssi", $name, $email, $age);

// Set parameters and execute
$name = "John";
$email = "john@example.com";
$age = 30;
$stmt->execute();

echo "New records created successfully";

$stmt->close();