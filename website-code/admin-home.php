<?php
session_start();

include "db_connection.php";

$selectall = "SELECT * from user";
$resultselectall = mysqli_query($connection, $selectall);

if (isset($_SESSION['user_id']) && isset($_SESSION['username'])) 
{
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
                            <button onclick="window.location.href='admin-createuser.php'">Create User Account</button>
                        </div>
                        <div class="horizontal-split-item-right">
                            <button onclick="window.location.href='processlogout.php'">Logout</button>
                        </div>
                    </div>
                    <?php $date = date('m/d/Y h:i:s a', time()); ?>
                    <h3>Today is
                        <?php echo $date ?>
                    </h3>
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
                                            <!--<td><button onclick="displayRelevant(0)" class="button-lock" name="lockbutton">Lock</button></td>
                                            <td><button onclick="displayRelevant(2)" class="button-delete" name="deletebutton" href="">Delete</button></td>-->
                                            <td><button name="lockbutton" class="button-lock" onclick="displayRelevant(0)">Lock</button></td>
                                            <td><button name="deletebutton" class="button-delete" onclick="displayRelevant(2)">Delete</button></td>
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
                                    <button name="confirm" class="confirmation-button-yes" onclick="lockUnlockDeleteAccount(0)">✔</button>
                                    <button name="cancel" class="confirmation-button-no" onclick="cancelAction()">X</button>
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
} 
else 
{
    header("Location: login.php");
    exit();
}
?>