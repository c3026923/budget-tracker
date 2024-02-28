<?php
session_start();
include "db_connection.php";

$lockuserid = "UPDATE user SET locked='1' WHERE user_id = ''";
mysqli_query($conn, $lockuserid);