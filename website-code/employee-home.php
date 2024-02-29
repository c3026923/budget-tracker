<?php
session_start();

include "db_connection.php";

$selectall = "SELECT * from user";
$resultselectall = mysqli_query($connection, $selectall);

if (isset($_SESSION['user_id']) && isset($_SESSION['username'])) {
    ?>

    <?php include 'includes/head.php'; ?>

    <head>
        <title>Budget Tracker | Employee Dashboard</title>
        <script src="scripts/datetime.js" defer></script>
        <script src="scripts/refresh.js" defer></script>
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
                            <button onclick="window.location.href='processlogout.php'">Logout</button>
                        </div>
                    </div>
                    <?php $date = date('m/d/Y h:i:s a', time()); ?>
                    <h3>Today is
                        <?php echo $date ?>
                    </h3>
                    <p>You have submitted X out of Y expense data submissions. Please continue to complete all outstanding expense submissions prior to close of day.</p>

                </div>
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