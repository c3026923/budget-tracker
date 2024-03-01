<?php

include "db_connection.php";

if (isset($_GET['expense_id']) && isset($_GET['expense_id']) && isset($_GET['expense_id']))
{
    $userId = $_SESSION['user_id'];
    $expenseId = $_GET['expense_id'];

    $updatequery = "";

    if (mysqli_query($connection, $updateQuery)) 
    {
        echo "User locked successfully.";
    } else 
    {
        echo "Error updating record: " . mysqli_error($connection);
    }
    mysqli_close($connection);
    header("Location: admin-home.php");
} 
else 
{
    header("Location: admin-home.php");
    exit();
}
