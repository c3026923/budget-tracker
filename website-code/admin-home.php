<?php
session_start();

include "db_connection.php";

$selectall = "SELECT * from user";
$resultselectall = mysqli_query($connection, $selectall);

if (isset($_SESSION['user_id']) && isset($_SESSION['username'])) {

    ?>

    <?php include 'includes/head.php'; ?>

    <head>
        <title>Budget Tracker | Admin Dashboard</title>
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
                        <div>
                            <a href="admin-createuser.php">Create User Account</a>
                        </div>
                        <div class="horizontal-split-item-right">
                            <a href="processlogout.php">Logout</a>
                        </div>
                    </div>
                    <?php $date = date('m/d/Y h:i:s a', time()); ?>
                    <h2>Today is
                        <?php echo $date ?>
                    </h2>
                    <p>Please see below a list of all accounts registered to the system.</p>
                    <div class="split-half">
                        <div class="split-half-left">
                            <table class="tableSection">
                                <tbody>
                                    <tr class="tableSection.body">
                                        <?php
                                        while ($row = mysqli_fetch_assoc($resultselectall)) {
                                            ?>
                                        <tr onclick="selectUser()" class="">
                                            <td>
                                                <?php echo $row['user_id']; ?>
                                                <br>
                                                <?php echo $row['first_name']; ?>
                                                <?php echo $row['surname']; ?>
                                            </td>
                                            <td><a onclick="toggleUnlock()" class="button-lock" name="lockbutton">Unlock/Lock</a></td>
                                            <td><a onclick="toggleDelete()" class="button-delete" name="deletebutton">Delete</a></td>
                                        </tr>
                                        </tr>
                                        <?php
                                        }
                                        ?>
                                </tbody>
                            </table>
                        </div>
                        <div class="split-half-right">
                            <p class="select-user-text">Select any user from the list to view further information and options.</p> 
                            <div class="confirmation-box">
                                <p class="confirmation-box-text">Are you sure that you wish to lock this account?</p>
                                <br>
                                <div class="confirmation-box-buttons">
                                    <button class="confirmation-button-yes">✔</button>
                                    <button class="confirmation-button-no">X</button>
                                </div>
                            </div>
                        </div>
                    </div>
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