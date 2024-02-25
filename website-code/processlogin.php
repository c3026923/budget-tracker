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
    else //User has entered something into username, password or both.
    {
        $selectusername = "SELECT * FROM user WHERE username = '$username'";
        $resultusername = mysqli_query($conn, $selectusername);

        if ($resultusername)
        {
            $rowfromusername = mysqli_fetch_assoc($resultusername);
            $passwordhashed = $rowfromusername['password']; //Get the hashed value from database/table.

            if ($passwordhashed && password_verify($password, $passwordhashed))//If the hashed value exists/is true and if it succeedes the verify check against user input for password.
            {
                if ($rowfromusername['password'] === $passwordhashed && $rowfromusername['locked'] == 0) //Password matches and the account is not locked.
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
                else 
                {
                    header("Location: login.php?error=Account is locked, please contact system  administrator");
                    exit();
                }
            } 
            else 
            {
                if ($failedloginattempts >= 4) 
                {
                    header("Location: login.php?error=Login attempts: $failedloginattempts. Account now locked");
                    $failedloginattempts = 0;
                    exit();
                } 
                else 
                {
                    $failedloginattempts++;
                    header("Location: login.php?error=incorrect password for this user. Login attempts: $failedloginattempts");
                    exit();
                }
            }
        } 
        else 
        {
            header("Location: login.php?error=login details are incorrect");
            exit();
        }
    }
} 
else 
{
    header("Location: login.php");
    exit();
}