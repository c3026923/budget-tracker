<?php
session_start();
include "db_connection.php";

if (isset($_POST['unlockbutton'])) //doesnt exist yet
{
    $unlockuserid = "UPDATE user SET locked='1' WHERE user_id = '1'";
    mysqli_query($connection, $unlockuserid);
}
else if(isset($_POST['lockbutton']))
{
    $lockuserid = "UPDATE user SET locked='1' WHERE user_id = '1'";
    mysqli_query($connection, $lockuserid);
}
else if(isset($_POST['deletebutton']))
{
    $deleteuserid = "UPDATE user SET locked='1' WHERE user_id = '14'";
    mysqli_query($connection, $deleteuserid);
}