<?php
session_start();

if (isset($_SESSION['user_id']) && isset($_SESSION['username'])) {

    ?>

    <?php include 'includes/head.php'; ?>

    <head>
        <title>Budget Tracker | Admin Dashboard</title>
    </head>

    <body>
        <div class="padding-bottom"></div>
        <div class="container-centered-wide">
            <div class="header-outer-region">
                <img src="images/testimage-long.png" class="image-fill" alt="" width="10">
            </div>
            <div class="main-body">
                <div class="horizontal-split">
                    <div>
                        <h1>Welcome, <?php echo $_SESSION['name']?></h1?>
                    </div>
                    <div>
                        <a href="admin-createuser.php">Create User Account</a>
                    </div>
                    <div class="horizontal-split-item-right">
                        <a href="processlogout.php">Logout</a>
                    </div>
                </div>
                <?php $date = date('Y-m-d H:i:s');?>
                <h2>Today is <?php $date?></h2>
                <p>You have submitted X out of Y target budget submissions. Please ensure that all areas have the most-recent target budget data uploaded to them.</p>
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