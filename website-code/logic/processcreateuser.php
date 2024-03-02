<?php
include "../includes/db_connection.php";
if (isset($_POST['departmentid']) && isset($_POST['firstname']) && isset($_POST['surname']) && isset($_POST['dob']) && isset($_POST['email']) && isset($_POST['employeetype']) && isset($_POST['locked']) && isset($_POST['createusername']) && isset($_POST['createpassword'])) 
{
    $departmentid = validate($_POST['departmentid']);
    $firstname = validate($_POST['firstname']);
    $surname = validate($_POST['surname']);
    $dob = validate($_POST['dob']);
    $email = validate($_POST['email']);
    $employeetype = validate($_POST['employeetype']);
    $locked = validate($_POST['locked']);
    $createusername = validate($_POST['createusername']);
    $createpassword = validate($_POST['createpassword']);

    $fields = array($departmentid, $firstname, $surname, $dob, $email, $employeetype, $locked, $createusername, $createpassword);
    foreach ($fields as $input) 
    {
        if (is_null($input)) 
        {
            mysqli_close($connection);
            header("Location: ../pages/home-admin.php?error=not all fields have been entered");
            exit();
        }
    }
    $passwordhashed = password_hash($createpassword, PASSWORD_DEFAULT);//Generate a hashed and salted version of password input.
    $sqlinsert = "INSERT INTO user (department_id, first_name, surname, dob, email, employee_type, locked, username, password)
                    VALUES ('$departmentid', '$firstname', '$surname', '$dob', '$email', '$employeetype', '$locked', '$createusername', '$passwordhashed');";
    mysqli_query($connection, $sqlinsert);

    mysqli_close($connection);
    header("Location: ../pages/admin-home.php");
} 
else 
{
    header("Location: ../pages/admin-home.php");
    exit();
}

function validate($data) //Strip out unwanted characters from input fields.
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
