<?php include 'includes/head.php'; ?>

<head>
    <title>Budget Tracker | Login</title>
</head>

<body>
    <div class="container-centered-login">
        <form action="processlogin.php" method="post">
            <div class="header-carousel-outer-region">
                <img src="images/testimage.png" class="image-fill" alt="" width="10">
            </div>
            <?php if (isset($_GET['error'])) { ?>
                <p class="errorbox">
                    <?php echo $_GET['error']; ?>
                </p>
            <?php } ?>
            <label>User Name</label>
            <input type="text" name="username" placeholder="Username">
            <label>Password</label>
            <input type="password" name="password" placeholder="Password">
            <button type="submit">Login</button>
        </form>
    </div>

</body>

</html>