<?php
session_start();

if (isset($_SESSION['user_id'])) 
{

    ?>

    <?php include 'includes/head.php'; ?>

    <head>
        <title>Budget Tracker | Dashboard</title>
    </head>

    <body>
        <div class="container-centered-background">
            <div class="container-centered-narrow">
                <div class="header-outer-region">
                    <img src="images/testimage-short.png" class="image-fill" alt="" width="340" height="130">
                </div>
                <div>
                    <div class="horizontal-split">
                        <div>
                            <h2>Please enter all required fields</h2>
                        </div>
                    </div>
                    <form action="processcreateuser.php" method="post">
                        <input type="number" name="departmentid" class="createinput" placeholder="Department ID">
                        <input type="text" name="firstname" class="createinput" placeholder="First Name">
                        <input type="text" name="surname" class="createinput" placeholder="Surname">
                        <input type="text" name="dob" class="createinput" placeholder="Date of Birth (YYYY-MM-DD)">
                        <input type="text" name="email" class="createinput" placeholder="Email Address">
                        <input type="number" class="createinput" name="employeetype"
                            placeholder="Employee Type (0: Employee, 1: Manager, 2: Admin)">
                        <input type="number" name="locked" class="createinput" placeholder="Lock Account? (0: No, 1: Yes)">
                        <input type="text" name="createusername" class="createinput" placeholder="Username">
                        <input type="text" name="createpassword" class="createinput" placeholder="Password">
                        <button type="submit">Submit (Create User)</button>
                    </form>
                </div>
                <button onclick="window.location.href='admin-home.php'" class="button-return">Return Home</button>
            </div>
        </div>

    </body>

    </html>
    <?php
}
else 
{
    header("Location: login.php");
    exit();
}
?>