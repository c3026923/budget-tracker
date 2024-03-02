<?php
include "../includes/db_connection.php";

session_start();

if (isset($_POST['budgetvalue']))
{
    $departmentid = $_SESSION['department_id'];
    $budgetvalue = validate($_POST['budgetvalue']);

    $sqlinsert = "UPDATE `budget` SET `value` = '$budgetvalue' WHERE `budget_id` = '$departmentid'";
    mysqli_query($connection, $sqlinsert);

    mysqli_close($connection);
    header("Location: ../pages/manager-home.php");
} 
else 
{
    header("Location: ../pages/manager-home.php");
    exit();
}

function validate($data) //Strip out unwanted characters from input fields.
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}