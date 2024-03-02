<?php
session_start();
include "../includes/db_connection.php";

if (isset($_POST['expensename']) && isset($_POST['expenseinfo']) && isset($_POST['expensevalue'])) 
{
    $userId = $_SESSION['user_id'];
    $name = validate($_POST['expensename']);
    $info = validate($_POST['expenseinfo']);
    $value = validate($_POST['expensevalue']);

    $insert = "INSERT INTO `expense_transaction` (`user_id`, `name`, `info`, `value`) VALUES ('$userId', '$name', '$info', '$value')";
    mysqli_query($connection, $insert);

    mysqli_close($connection);
    header("Location: ../pages/employee-home.php");
} 
else 
{
    header("Location: ../pages/employee-home.php?error=not all fields have been entered");
    exit();
}

function validate($data) //Strip out unwanted characters from input fields.
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}