<?php
session_start();

include "../includes/db_connection.php";

$userid = $_SESSION['user_id'];
$submissions = "SELECT * FROM income_transaction WHERE user_id = '$userid'";
$result = mysqli_query($connection, $submissions);
$count = 0;

if (mysqli_num_rows($result) != 0)
{
    $count = mysqli_num_rows($result);
}

?>

<?php include '../includes/head.php'; ?>

<head>
    <title>Budget Tracker | Submit Income </title>
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
                        <button onclick="window.location.href='manager-edittransactions.php'">Edit Your Submitted Transaction(s) for Department</button>
                    </div>
                </div>
                <p>You have submitted <?php echo $count ?> income transaction submissions. Please continue to complete any outstanding income submissions prior to close of day.</p>
                <p>Submit a new transaction:</p>
                <form action="../logic/processsubmitincome.php" method="post">
                    <input type="text" name="incomename" class="" placeholder="Income Name">
                    <input type="text" name="incomeinfo" class="" placeholder="Income Information">
                    <input type="number" step="0.01" min="0" name="incomevalue" class="" placeholder="Value">
                    <button type="submit">Submit Transaction</button>
                </form>
            </div>
            <button onclick="window.location.href='manager-home.php'" class="button-return">Return Home</button>
        </div>
    </div>
</body>

</html>