<?php

include "../includes/db_connection.php";

session_start();

if (isset($_POST['name']) && isset($_POST['info']) && isset($_POST['value'])) 
{
    $name = validate($_POST['name']);
    $info = validate($_POST['info']);
    $value = validate($_POST['value']);
    $incomeid = $_POST['incomeid'];

    $query = "UPDATE income_transaction SET `name` = '$name', `info` = '$info', `value` = '$value' WHERE `income_transaction`.`income_id` = '$incomeid'";
    mysqli_query($connection, $query);

    mysqli_close($connection);
    header("Location: ../pages/manager-edittransactions.php");
}
else 
{
    header("Location: ../pages/manager-edittransactions.php");
    exit();
}

function validate($data) //Strip out unwanted characters from input fields.
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}