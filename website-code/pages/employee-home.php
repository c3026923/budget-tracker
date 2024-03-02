<?php
session_start();

include "../includes/db_connection.php";

if (isset($_SESSION['user_id'])) //If we somehow reach this page without having a global session user_id, go to the else part which is to send them back to login page.
{
    $userid = $_SESSION['user_id'];

    $determineusertype = "SELECT employee_type from user WHERE user_id = '$userid'";
    $result1 = mysqli_query($connection, $determineusertype);
    $row = mysqli_fetch_assoc($result1);
    
    if($row['employee_type'] != 0) //If the user is logged in as someone who isn't an employee and decides to try and access the employee page by changing the url manually, send them back to login page.
    {
        header("Location: processlogout.php");
        exit();
    }

    $submissions = "SELECT * FROM expense_transaction WHERE user_id = '$userid'";
    $result2 = mysqli_query($connection, $submissions);
    $count = 0;

    if (mysqli_num_rows($result2) != 0)
    {
        $count = mysqli_num_rows($result2);
    }
    ?>

    <?php include '../includes/head.php'; ?>

    <head>
        <title>Budget Tracker | Employee Dashboard</title>
        <script src="scripts/datetime.js" defer></script>
    </head>

    <body>
        <div class="container-centered-background">
            <div class="container-centered-wide">
                <div class="header-outer-region">
                    <img src="../images/testimage-long.png" class="image-fill" alt="" width="780" height="130">
                </div>
                <div class="main-body">
                    <div class="horizontal-split">
                        <div>
                            <h1>Welcome,
                                <?php echo $_SESSION['name'] ?>
                                </h1?>
                        </div>
                        <div>
                            <button onclick="window.location.href='../pages/employee-edittransactions.php'">Edit Your Submitted Transaction(s) for Department</button>
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
                    <p>You have submitted <?php echo $count ?> expense transaction submissions. Please continue to complete any outstanding expense submissions prior to close of day.</p>
                    <p>Submit a new transaction:</p>
                    <form action="../logic/processsubmitexpense.php" method="post">
                        <input type="text" name="expensename" class="" placeholder="Expense Name">
                        <input type="text" name="expenseinfo" class="" placeholder="Expense Information">
                        <input type="number" step="0.01" min="0" name="expensevalue" class="" placeholder="Value">
                        <button type="submit">Submit Transaction</button>
                    </form>
                </div>
            </div>
        </div>
    </body>

    </html>
    <?php
} 
else 
{
    header("Location: ../pages/login.php");
    exit();
}
?>