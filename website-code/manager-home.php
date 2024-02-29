<?php
session_start();

include "db_connection.php";

$selectall = "SELECT * from user";
$resultselectall = mysqli_query($connection, $selectall);

if (isset($_SESSION['user_id']) && isset($_SESSION['username'])) {
    ?>

    <?php include 'includes/head.php'; ?>

    <head>
        <title>Budget Tracker | Manager Dashboard</title>
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
                            <button onclick="window.location.href='manager-assigntarget.php'">Assign Department's Target Expenditure</button>
                            <button onclick="window.location.href='manager-submittransaction.php'">Submit Transaction(s) for Department</button>
                        </div>
                        <div class="horizontal-split-item-right">
                            <button onclick="window.location.href='processlogout.php'">Logout</button>
                        </div>
                    </div>
                    <?php $date = date('m/d/Y h:i:s a', time()); ?>
                    <h3>Today is
                        <?php echo $date ?>
                    </h3>
                    <p>Please ensure that all mandatory transactions have the most-recent data uploaded to them.</p>
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
                                        </tr>
                                        <?php
                                        }
                                        ?>
                                </tbody>
                            </table>
                        </div>
                        <div class="split-half-right">
                            <p class="select-user-text">Here you can find a list of every employee under your department. Please click on a user from the list on the left. Once you have done so, further options will become available for the selected user.</p>
                            <div class="confirmation-box">
                                <p>Please see below the list of this employee's assigned mandatory transactions:</p>
                                <br>
                                <div>

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