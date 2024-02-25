<?php
session_start();

if (isset($_SESSION['user_id']) && isset($_SESSION['username'])) {

    ?>

    <?php include 'includes/head.php'; ?>

    <head>
        <title>Budget Tracker | Employee Dashboard</title>
    </head>

    <body>
        <div class="container-centered">
            <div class="header-carousel-outer-region">
                <img src="images/testimage.png" class="image-fill" alt="" width="10">
            </div>
            <div>
                <div class="horizontal-split">
                    <h1>Welcome,
                        <?php echo $_SESSION['name'] ?>
                    </h1?>
                    <a href="processlogout.php">Logout</a>
                </div>
                <p>AAAAAAAAAAAAAAAAAAA</p>
                <p>AAAAAAAAAAAAAAAAAAA</p>
            </div>
        </div>
    </body>

    </html>
    <?php
} else {
    header("Location: processlogin.php");
    exit();
}
?>