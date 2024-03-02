<?php

include "../includes/db_connection.php";

if (isset($_GET['user_id'])) 
{
    $userId = $_GET['user_id'];
    $updateQuery = "UPDATE user SET locked = '0' WHERE user_id = '$userId'";

    if (mysqli_query($connection, $updateQuery)) 
    {
        echo "User locked successfully.";
    } else 
    {
        echo "Error updating record: " . mysqli_error($connection);
    }
    mysqli_close($connection);
    header("Location: ../pages/admin-home.php");
} 
else 
{
    header("Location: ../pages/admin-home.php");
    exit();
}
