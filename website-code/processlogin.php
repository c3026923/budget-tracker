<?php
session_start();
include "db_conn.php";
if(isset($_POST['username']) && isset($_POST['password']))
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

    if(empty($username))
    {
        header("Location: login.php?error=username is required");
        exit();
    }
    else if(empty($password))
    {
        header("Location: login.php?error=password is required");
        exit();
    }
    else //User has entered something into username, password or both.
    {
        $selectuser = "SELECT * FROM user WHERE username = '$username'";
        $resultuser = mysqli_query($conn, $selectuser);

        if(mysqli_num_rows($resultuser) === 1)//If there's only one username match
        {
            $passwordhashed = password_hash($password, PASSWORD_DEFAULT);
            if(password_verify($password, $passwordhashed)) //User's input password matches the new hash check.
            {
                $row = mysqli_fetch_assoc($resultuser);
                if($row['username'] === $username)
                {
                    $_SESSION['username'] = $row['username'];
                    $_SESSION['name'] = $row['first_name'];
                    $_SESSION['user_id'] = $row['user_id'];
    
                    header("Location: home-admin.php");
                    exit();
                }
            }
        }
        else
        {
            header("Location: login.php?error=login details are incorrect");
            //Increment unsuccessful login attempt here.
            exit();
        }
    }
}
else
{
    header("Location: home-admin.php");
    exit();
}