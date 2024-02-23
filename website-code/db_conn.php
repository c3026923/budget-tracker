<?php

$sname = "localhost";
$uname = "root";
$password = "";

$db_name = "budget-tracker_schema";
$conn = mysqli_connect($sname, $uname, $password, $db_name);

if (!$conn) {
    echo "The attempted connection to database has failed.";
}