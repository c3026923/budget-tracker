<?php
session_start();

if (isset($_SESSION['user_id']) && isset($_SESSION['username'])) {

    ?>

    <?php include 'includes/head.php'; ?>

    <head>
        <title>Budget Tracker | Dashboard</title>
    </head>

    <body>
        <div class="padding-bottom"></div>
        <div class="container-centered-narrow">
            <div class="header-outer-region">
                <img src="images/testimage-long.png" class="image-fill" alt="" width="10">
            </div>
            <div>
                <div class="horizontal-split">
                    <div>
                        <h1>Welcome, <?php echo $_SESSION['name'] ?></h1?>
                    </div>
                    <div>
                        <a href="processlogout.php">Logout</a>
                    </div>
                </div>
                <form action="createuser.php" method="post">
                    <?php if (isset($_GET['error'])) { ?>
                        <p class="errorbox">
                            <?php echo $_GET['error']; ?>
                        </p>
                    <?php } ?>
                    <input type="number" name="departmentid" placeholder="Department ID">
                    <input type="text" name="firstname" placeholder="First Name">
                    <input type="text" name="surname" placeholder="Surname">
                    <input type="text" name="dob" placeholder="Date of Birth (YYYY-MM-DD)">
                    <input type="text" name="email" placeholder="Email Address">
                    <input type="number" name="employeetype" placeholder="Employee Type (0: Employee, 1: Manager, 2: Admin)">
                    <input type="number" name="locked" placeholder="Lock Account? (0: No, 1: Yes)">
                    <input type="text" name="createusername" placeholder="Username">
                    <input type="text" name="createpassword" placeholder="Password">
                    <button type="submit">CREATE USER</button>
                </form>
            </div>
        </div>
    </body>

    </html>
    <?php
} else {
    header("Location: login.php");
    exit();
}
?>