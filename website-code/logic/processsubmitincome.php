<?php
session_start();
include "../includes/db_connection.php";

if (isset($_POST['incomename']) && isset($_POST['incomeinfo']) && isset($_POST['incomevalue'])) 
{
    $userId = $_SESSION['user_id'];
    $name = validate($_POST['incomename']);
    $info = validate($_POST['incomeinfo']);
    $value = validate($_POST['incomevalue']);

    $insert = "INSERT INTO `income_transaction` (`user_id`, `name`, `info`, `value`) VALUES ('$userId', '$name', '$info', '$value')";
    mysqli_query($connection, $insert);

    mysqli_close($connection);
    header("Location: ../pages/manager-submittransaction.php");
} 
else 
{
    header("Location: ../pages/manager-submittransaction.php?error=not all fields have been entered");
    exit();
}

function validate($data) //Strip out unwanted characters from input fields.
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}