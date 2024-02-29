<?php

include "db_connection.php";

if (isset($_GET['user_id'])) 
{
    $userId = $_GET['user_id'];

    // Validate user ID (e.g., check if it's a valid integer, etc.)
    // Perform any additional validation if necessary

    // SQL query to update the 'locked' column for the specified user ID
    $deleteQuery = "DELETE FROM user WHERE user_id = '$userId'";

    // Execute the query
    if (mysqli_query($connection, $deleteQuery)) 
    {
        echo "User deleted  successfully.";
    } else 
    {
        echo "Error deleting user: " . mysqli_error($connection);
    }

    // Close the database connection
    mysqli_close($connection);
} 
else 
{
    echo "User ID not provided.";
}
