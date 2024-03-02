<?php

include "../includes/db_connection.php";

session_start();

$employeeid = $_SESSION['selectedemployee'];

$query = "SELECT * from expense_transaction WHERE user_id = '$employeeid'";
$result = mysqli_query($connection, $query);

if (mysqli_num_rows($result) > 0) 
{
    while ($row = mysqli_fetch_assoc($result)) 
    {
        echo "<tr class='unclicked' onclick='selectUser(this)'>";
        echo "<td width=133%>" . $row['name'] . "</td>";
        echo "<td width=133%>" . $row['info'] . "</td>";
        echo "<td width=133%>" . $row['value'] . "</td>";
        echo "</tr>";
    }
}

mysqli_close($connection);
