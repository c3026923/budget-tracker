<?php

include "../includes/db_connection.php";

session_start();

if (isset($_POST['name']) && isset($_POST['info']) && isset($_POST['value'])) 
{
    $name = validate($_POST['name']);
    $info = validate($_POST['info']);
    $value = validate($_POST['value']);
    $expenseid = $_POST['expenseid'];

    $query = "UPDATE expense_transaction SET `name` = '$name', `info` = '$info', `value` = '$value' WHERE `expense_transaction`.`expense_id` = '$expenseid'";
    mysqli_query($connection, $query);

    mysqli_close($connection);
    header("Location: ../pages/employee-edittransactions.php");
}
else 
{
    header("Location: ../pages/employee-edittransactions.php");
    exit();
}

function validate($data) //Strip out unwanted characters from input fields.
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}