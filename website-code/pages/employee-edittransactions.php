<?php
session_start();

include "../includes/db_connection.php";

$userid = $_SESSION['user_id'];

$selectalltransactions = "SELECT * FROM expense_transaction WHERE user_id = '$userid'";
$result = mysqli_query($connection, $selectalltransactions);

?>

<?php include '../includes/head.php'; ?>

<head>
    <title>Budget Tracker | Edit Transactions </title>
    <script src="../scripts/edittransaction.js" defer></script>
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
                        <button onclick="window.location.href='employee-home.php'">Return Home</button>
                    </div>
                </div>
                <p>Please see below a list of all transactions you have submitted for your department.</p>
                <table class="tableSection">
                    <thead>
                        <th class="th-transaction">Expense Transaction Name</th>
                        <th class="th-transaction">Expense Transaction Information</th>
                        <th class="th-transaction">Expense Transaction Value</th>
                        <th class="th-transaction">Action</th>
                    </thead>
                    <tbody>
                        <tr class="tableSection.body">
                            <?php
                            while ($row = mysqli_fetch_assoc($result)) 
                            {
                                ?>
                                <tr onclick="selectTransaction(this)" class="unclicked">
                                <td class="td-transaction"><?php echo $row['name']; ?></td>
                                <td class="td-transaction"><?php echo $row['info']; ?></td>
                                <td class="td-transaction"><?php echo $row['value']; ?></td>
                                <td class="td-transaction"><button onclick="confirmActionEmployee(this, 0)" class="button-edit" data-transaction_id="<?php echo $row['expense_id']; ?>">Edit</button></td>
                                </tr>
                                <?php
                            }
                            ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>

</html>