<?php
session_start();

include "db_connection.php";

$userid = $_SESSION['user_id'];

$selectalltransactions = "SELECT * FROM expense_transaction WHERE user_id = '$userid'";
$result = mysqli_query($connection, $selectalltransactions);

//NEED TO SOMEHOW TURN QUERY ABOVE INTO A NEW TABLE WITH JUST THE DATA ABOVE AND AUTOINCREMENTING

?>

<?php include 'includes/head.php'; ?>

<head>
    <title>Budget Tracker | Submit Transactions </title>
    <script src="scripts/edittransaction.js" defer></script>
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
                                <tr onclick="selectTransaction(this)" class="unclicked" data-transaction_id="<?php echo $row['expense_id']; ?>"> <!-- Concept of data- to store data taken from https://www.w3schools.com/TAGS/att_data-.asp -->
                                <!--THE ABOVE IS FAILING BECAUSE THE ID IS 3 ON THE RECORD INSTEAD OF 1 AS ITS THIRD ON LIST OF ALL TRANSACTIONS 
                                    NOT SPECIFICALLY THE EMPLOYEE'S. POTENTIAL FIX IS TO USE NEW SQL QUERY TO DO SQL JOIN AND MAYBE THIS WILL LIST THEM BY NUMBER?>-->
                                <td class="td-transaction"><?php echo $row['name']; ?></td>
                                <td class="td-transaction"><?php echo $row['info']; ?></td>
                                <td class="td-transaction"><?php echo $row['value']; ?></td>
                                <td class="td-transaction"><button onclick="editTransaction()" class="button-edit">Edit</button></td>
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