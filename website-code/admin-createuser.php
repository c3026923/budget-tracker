<?php
session_start();

if (isset($_SESSION['user_id']) && isset($_SESSION['username'])) {

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
                            <h1>Please enter all required fields:</h1?>
                        </div>
                        <div class="horizontal-split-item-right">
                            <a href="processlogout.php">Logout</a>
                        </div>
                    </div>
                    <form action="createuser.php" method="post">
                        <?php if (isset($_GET['error'])) { ?>
                            <p class="error">
                                <?php echo $_GET['error']; ?>
                            </p>
                        <?php } ?>
                        <input type="number" name="departmentid" placeholder="Department ID">
                        <input type="text" name="firstname" placeholder="First Name">
                        <input type="text" name="surname" placeholder="Surname">
                        <input type="text" name="dob" placeholder="Date of Birth (YYYY-MM-DD)">
                        <input type="text" name="email" placeholder="Email Address">
                        <input type="number" name="employeetype"
                            placeholder="Employee Type (0: Employee, 1: Manager, 2: Admin)">
                        <input type="number" name="locked" placeholder="Lock Account? (0: No, 1: Yes)">
                        <input type="text" name="createusername" placeholder="Username">
                        <input type="text" name="createpassword" placeholder="Password">
                        <button type="submit">CREATE USER</button>
                    </form>
                </div>
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