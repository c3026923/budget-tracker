<?php include 'includes/head.php'; ?>

<head>
    <title>Budget Tracker | Login</title>
</head>

<body>
    <div class="container-centered-background">
        <div class="container-centered-login">
            <form action="processlogin.php" method="post">
                <div class="header-outer-region">
                    <img src="images/testimage-short.png" class="image-fill" alt="" width="340" height="130">
                </div>
                <?php if (isset($_GET['error'])) { ?>
                    <p class="error">
                        <?php echo $_GET['error']; ?>
                    </p>
                <?php } ?>
                <label>User Name</label>
                <input type="text" name="username" placeholder="Username">
                <label>Password</label>
                <input type="password" name="password" placeholder="Password">
                <button type="submit">Login</button>
            </form>
            <div>
                <!--<a href="testforcepassword.php">BRUTE FORCE NEW PASSWORD</a>-->
            </div>
        </div>
    </div>
</body>

</html>