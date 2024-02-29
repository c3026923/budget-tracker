<?php

include "db_connection.php";

if (isset($_GET['user_id'])) 
{
    $userId = $_GET['user_id'];
    $deleteQuery = "DELETE FROM user WHERE user_id = '$userId'";

    if (mysqli_query($connection, $deleteQuery)) 
    {
        echo "User deleted  successfully.";
    } else 
    {
        echo "Error deleting user: " . mysqli_error($connection);
    }
    mysqli_close($connection);
    header("Location: admin-home.php");} 
else 
{
    header("Location: admin-home.php");
    exit();
}
