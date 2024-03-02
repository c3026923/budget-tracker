<?php

$sname = "localhost";
$uname = "root";
$password = "";

$db_name = "budget_tracker_schema";
$connection = mysqli_connect($sname, $uname, $password, $db_name);

if (!$connection) 
{
    echo "The attempted connection to database has failed.";
}