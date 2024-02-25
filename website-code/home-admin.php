<?php
session_start();

if (isset($_SESSION['user_id']) && isset($_SESSION['username'])) {

    ?>

    <?php include 'includes/head.php'; ?>

    <head>
        <title>Budget Tracker | Admin Dashboard</title>
    </head>

    <body>
        <div class="container-centered-background">
            <div class="container-centered-wide">
                <div class="header-outer-region">
                    <img src="images/testimage-long.png" class="image-fill" alt="" width="780" height="130">
                </div>
                <div class="main-body">
                    <div class="horizontal-split">
                        <div>
                            <h1>Welcome,
                                <?php echo $_SESSION['name'] ?>
                                </h1?>
                        </div>
                        <div>
                            <a href="admin-createuser.php">Create User Account</a>
                        </div>
                        <div class="horizontal-split-item-right">
                            <a href="processlogout.php">Logout</a>
                        </div>
                    </div>
                    <?php $date = date('Y-m-d H:i:s'); ?>
                    <h2>Today is
                        <?php $date ?>
                    </h2>
                    <p>Please see below a list of all accounts registered to the system.</p>
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