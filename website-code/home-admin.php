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
        <script src="scripts/selectuser.js" defer></script>
        <!--<script src="scripts/createclickablerows.js" defer></script>-->
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
                                            <td>
                                                <button onclick="selectUser(this)" class="button-fillcell">
                                                    <?php echo $row['user_id']; ?>
                                                    <br>
                                                    <?php echo $row['first_name']; ?>
                                                    <?php echo $row['surname']; ?>
                                                </button>
                                            </td>
                                            <td><a href="" class="button-lock">Unlock/Lock</a></td>
                                            <td><a href="" class="button-delete">Delete</a></td>
                                        </tr>
                                        <?php
                                        }
                                        ?>
                                </tbody>
                            </table>
                        </div>
                        <div class="split-half-right">
                            <a href="accountlock.php">LOCK ACCOUNT TEST</a>
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