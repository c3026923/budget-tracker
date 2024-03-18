<?php
session_start();

include "../includes/db_connection.php";

if (isset($_SESSION['user_id'])) //If we somehow reach this page without having a global session user_id, go to the else part which is to send them back to login page.
{
    $userid = $_SESSION['user_id'];

    $determineusertype = "SELECT employee_type from user WHERE user_id = '$userid'";
    $result1 = mysqli_query($connection, $determineusertype);
    $row = mysqli_fetch_assoc($result1);
    
    if($row['employee_type'] != 2) //If the is was logged in as someone who isn't an admin and decides to try and access the admin page by changing the url manually, send them back to login page.
    {
        header("Location: ../logic/processlogout.php");
        exit();
    }

    $selectallusers = "SELECT * from user";
    $result2 = mysqli_query($connection, $selectallusers);

    ?>

    <?php include '../includes/head.php'; ?>

    <head>
        <title>Budget Tracker | Admin Dashboard</title>
        <script src="../scripts/selection.js" defer></script>
    </head>

    <body>
        <div class="container-centered-background">
            <div class="container-centered-wide">
                <div class="header-outer-region">
                    <div class="header-solid-block">
                        <img src="../images/logoimage-long.png" alt="" width="780" height="130">
                    </div>
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
                            <button onclick="window.location.href='../logic/processlogout.php'">Logout</button>
                        </div>
                    </div>
                    <?php $date = date('l, jS \of F Y');  ?>
                    <?php $time = date('h:i:s A');  ?>
                    <h3>Today is
                        <?php echo $date ?> and the time is
                        <?php echo $time ?>
                    </h3>
                    <p>Please see below a list of all accounts registered to the system.</p>
                    <div class="split-half">
                        <div class="split-half-left">
                            <table class="tableSection">
                                <tbody class="staff-list">
                                    <tr class="tableSection.body">
                                        <?php
                                        while ($row = mysqli_fetch_assoc($result2)) 
                                        {
                                            ?>
                                            <tr onclick="selectRow(this, 2)" data-userid="<?php echo $row['user_id']; ?>"> <!-- Concept of data- to store data taken from https://www.w3schools.com/TAGS/att_data-.asp -->
                                            <td class="td-name-section"><?php echo $row['user_id']; ?>
                                                <br>
                                                <?php echo $row['first_name'] . ' ' . $row['surname']; ?>
                                            </td>
                                            <td><button onclick="confirmAdminAction(0)" class="button-unlock">Unlock</button></td>
                                            <td><button onclick="confirmAdminAction(1)" class="button-lock">Lock</button></td>
                                            <td><button onclick="confirmAdminAction(2)" class="button-delete">Delete</button></td>
                                        </tr>
                                        <?php
                                        }
                                        ?>
                                </tbody>
                            </table>
                        </div>
                        <div class="split-half-right">
                            <p class="select-user-text">Here you can find a list of every staff member across all departments. Please click on a user from the full staff list on the left. Once you have done so, further options will become available for the selected user; unlocking their account, locking their account and deleting their account.</p>
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