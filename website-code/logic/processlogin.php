<?php
session_start();
include "../includes/db_connection.php";
if (isset($_POST['username']) && isset($_POST['password'])) 
{
    $username = validate($_POST['username']);
    $password = validate($_POST['password']);

    if (empty($username)) 
    {
        mysqli_close($connection);
        header("Location: ../pages/login.php?error=username is required");
        exit();
    } 
    else if (empty($password)) 
    {
        mysqli_close($connection);
        header("Location: ../pages/login.php?error=password is required");
        exit();
    } 
    else //User has entered something into username and password.
    {
        $selectusername = "SELECT * FROM user WHERE username = '$username'";
        $result = mysqli_query($connection, $selectusername);

        if($_SESSION['latestusername'] != $username) //If a new username is being used, it won't be a consecutive login attempt.
        {
            $_SESSION['loginattempts']  = 1;
        }

        if (mysqli_num_rows($result) != 0)
        {
            $rowfromusername = mysqli_fetch_assoc($result);
            $_SESSION['latestusername'] = $rowfromusername['username'];

            if($rowfromusername['locked'] == 1) //If the account is locked, no use going further.
            {
                mysqli_close($connection);
                header("Location: ../pages/login.php?error=Account is locked, please contact system  administrator");
                exit();
            }

            $passwordhashed = $rowfromusername['password']; //Get the saved hashed value from database/table.

            if ($passwordhashed && password_verify($password, $passwordhashed))//Successful login; the hashed value exists/is true and if it succeedes the verify check against user input for password.
            {
                $_SESSION['user_id'] = $rowfromusername['user_id'];
                $_SESSION['name'] = $rowfromusername['first_name'];
                $_SESSION['department_id'] = $rowfromusername['department_id'];
                    
                switch ($rowfromusername['employee_type'])
                {
                    case 0:
                        mysqli_close($connection);
                        header("Location: ../pages/employee-home.php");
                        exit();
                    case 1:
                        mysqli_close($connection);
                        header("Location: ../pages/manager-home.php");
                        exit();
                    case 2:
                        mysqli_close($connection);
                        header("Location: ../pages/admin-home.php");
                        exit();
                }
            } 
            else //Unsuccessful login; password is incorrect.
            {
                if($rowfromusername['employee_type'] == 2)//If they're an admin, don't bother trying to track unsuccessful login counts.
                {
                    mysqli_close($connection);
                    header("Location: ../pages/login.php?error=incorrect password for this administator account");
                    exit();
                }

                $attempts = $_SESSION['loginattempts'];

                if ($attempts >= 3) 
                {
                    header("Location: ../pages/login.php?error=Login attempts: $attempts. Account now locked");
                    $sqllockacc = "UPDATE user SET locked='1' WHERE username = '$username'";
                    mysqli_query($connection, $sqllockacc);
                    mysqli_close($connection);
                    $_SESSION['loginattempts']  = 0;
                    exit();
                } 
                else 
                {
                    mysqli_close($connection);
                    $_SESSION['loginattempts']++;
                    header("Location: ../pages/login.php?error=incorrect password for this user. Login attempts: $attempts");
                    exit();
                }
            }
        } 
        else 
        {
            mysqli_close($connection);
            header("Location: ../pages/login.php?error=username not recognized");
            exit();
        }
    }
} 
else 
{
    mysqli_close($connection);
    header("Location: ../pages/login.php");
    exit();
}

function validate($data) //Strip out unwanted characters from input fields.
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}