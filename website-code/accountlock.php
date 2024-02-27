<?php
include "db_connection.php";

if($_SESSION['selecteduser'])
{
    $sqllockacc = "UPDATE user SET locked='1' WHERE username = 'pallen'";
    mysqli_query($connection, $sqllockacc);
}
else
{

}