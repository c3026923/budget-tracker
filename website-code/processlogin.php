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
        $sql = "SELECT * FROM user WHERE username = '$username' AND password= '$password'"; //Search for matching username and password from db.

        $result = mysqli_query($conn, $sql);

        if(mysqli_num_rows($result) === 1)//If there's a match (can only be one result)
        {
            $row = mysqli_fetch_assoc($result);
            if($row['username'] === $username && $row['password'] === $password)
            {
                $_SESSION['username'] = $row['username'];
                $_SESSION['name'] = $row['first_name'];
                $_SESSION['user_id'] = $row['user_id'];

                header("Location: home.php");
                exit();
            }
        }
        else
        {
            header("Location: login.php?error=login details are incorrect.");
            //Increment unsuccessful login attempt here.
            exit();
        }
    }
}
else
{
    header("Location: home.php");
    exit();
}