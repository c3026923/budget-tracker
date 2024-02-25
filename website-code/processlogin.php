<?php
session_start();
include "db_conn.php";
if (isset($_POST['username']) && isset($_POST['password'])) 
{
    function validate($data) //Strip out unwanted characters from input fields.
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
    $username = validate($_POST['username']);
    $password = validate($_POST['password']);

    if (empty($username)) 
    {
        header("Location: login.php?error=username is required");
        exit();
    } 
    else if (empty($password)) 
    {
        header("Location: login.php?error=password is required");
        exit();
    } 
    else //User has entered something into username and password.
    {
        $selectusername = "SELECT * FROM user WHERE username = '$username'";
        $resultusername = mysqli_query($conn, $selectusername);

        if($_SESSION['latestusername'] != $username) //If a new username is being used, it won't be a consecutive login attempt.
        {
            $_SESSION['loginattempts']  = 1;
        }

        if ($resultusername)
        {
            $rowfromusername = mysqli_fetch_assoc($resultusername);
            $_SESSION['latestusername'] = $rowfromusername['username'];

            if($rowfromusername['locked'] == 1) //If the account is locked, no use going further.
            {
                header("Location: login.php?error=Account is locked, please contact system  administrator");
                exit();
            }

            $passwordhashed = $rowfromusername['password']; //Get the saved hashed value from database/table.

            if ($passwordhashed && password_verify($password, $passwordhashed))//Successful login; the hashed value exists/is true and if it succeedes the verify check against user input for password.
            {
                $_SESSION['username'] = $rowfromusername['username'];
                $_SESSION['name'] = $rowfromusername['first_name'];
                $_SESSION['user_id'] = $rowfromusername['user_id'];
                    
                switch ($rowfromusername['employee_type'])
                {
                    case 0:
                        header("Location: home-employee.php");
                        exit();
                    case 1:
                        header("Location: home-manager.php");
                        exit();
                    case 2:
                        header("Location: home-admin.php");
                        exit();
                }
            } 
            else //Unsuccessful login; password is incorrect.
            {
                if($rowfromusername['employee_type'] == 2)//If they're an admin, don't bother trying to track unsuccessful login counts.
                {
                    header("Location: login.php?error=incorrect password for this administator account");
                    exit();
                }

                $attempts = $_SESSION['loginattempts'];

                if ($attempts >= 3) 
                {
                    header("Location: login.php?error=Login attempts: $attempts. Account now locked");
                    $sqllockacc = "UPDATE user SET locked='1' WHERE username = '$username'";
                    mysqli_query($conn, $sqllockacc);
                    $_SESSION['loginattempts']  = 0;
                    exit();
                } 
                else 
                {
                    $_SESSION['loginattempts']++;
                    header("Location: login.php?error=incorrect password for this user. Login attempts: $attempts");
                    exit();
                }
            }
        } 
        else 
        {
            header("Location: login.php?error=username not recognized");
            exit();
        }
    }
} 
else 
{
    header("Location: login.php");
    exit();
}