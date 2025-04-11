<?php
session_start();
// session_destroy();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Session check page</title>
</head>
<body>
    <table>
        <tr>
            <th>visit id</th>
            <th>customer id</th>
            <th>customer name</th>
            <th>contact no</th>
            <th>no of person</th>
        </tr>
        <tr>
            <td><?= $_SESSION['visit_id'] ?></td>
            <td><?= $_SESSION['customer_id'] ?></td>
            <td><?= $_SESSION['full_name'] ?></td>
            <td><?= $_SESSION['contact_no'] ?></td>
            <td><?= $_SESSION['no_of_person'] ?></td>
        </tr>
    </table>
</body>
</html>