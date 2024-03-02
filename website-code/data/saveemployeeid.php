<?php

session_start();

if (isset($_POST['userID'])) 
{
    $_SESSION['selectedemployee'] = $_POST['userID'];
    echo "userID saved";
} 
else 
{
    echo "userID not saved";
}
