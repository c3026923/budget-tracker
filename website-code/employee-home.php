<?php
session_start();

if (isset($_SESSION['user_id']) && isset($_SESSION['username'])) {

    ?>

    <?php include 'includes/head.php'; ?>

    <head>
        <title>Budget Tracker | Employee Dashboard</title>
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
                        <div class="horizontal-split-item-right">
                            <a href="processlogout.php">Logout</a>
                        </div>
                    </div>
                    <?php $date = date('Y-m-d H:i:s'); ?>
                    <h2>Today is
                        <?php $date ?>
                    </h2>
                    <p>You have submitted X out of Y expense data submissions. Please continue to complete all outstanding
                        expense submissions prior to close of day.</p>
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