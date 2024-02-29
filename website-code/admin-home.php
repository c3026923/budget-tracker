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
                                        while ($row = mysqli_fetch_assoc($resultselectall)) 
                                        {
                                            ?>
                                            <tr onclick="selectUser(this)" data-userid="<?php echo $row['user_id']; ?>"> <!-- Concept of data- to store data taken from https://www.w3schools.com/TAGS/att_data-.asp -->
                                            <td><?php echo $row['user_id']; ?>
                                                <br>
                                                <?php echo $row['first_name'] . ' ' . $row['surname']; ?>
                                            </td>
                                            <td><button onclick="confirmAction(0)" class="button-unlock">Unlock</button></td>
                                            <td><button onclick="confirmAction(1)" class="button-lock">Lock</button></td>
                                            <td><button onclick="confirmAction(2)" class="button-delete">Delete</button></td>
                                        </tr>
                                        <?php
                                        }
                                        ?>
                                </tbody>
                            </table>
                        </div>
                        <div class="split-half-right">
                            <p class="select-user-text">Here you can find a list of every staff member across all departments. Please click on a user from the full staff list on the left. Once you have done so, further options will become available for the selected user; unlocking their account, locking their account and deleting their account.</p>
                            <!--<div class="confirmation-box">
                                <p class="confirmation-box-text">Are you sure that you wish to lock this account?</p>
                                <br>
                                <div class="confirmation-box-buttons">
                                    <button name="confirm" class="confirmation-button-yes" onclick="lockUnlockDeleteAccount(0)">✔</button>
                                    <button name="cancel" class="confirmation-button-no" onclick="cancelAction()">X</button>
                                </div>
                            </div>-->
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