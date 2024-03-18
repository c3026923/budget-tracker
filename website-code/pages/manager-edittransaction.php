<?php

include "../includes/db_connection.php";

session_start();

if (isset($_GET['income_id'])) 
{
    $incomeid = $_GET['income_id'];

    $selecttransaction = "SELECT * FROM income_transaction WHERE income_id = '$incomeid'";
    $result = mysqli_query($connection, $selecttransaction);

    ?>

    <?php include '../includes/head.php'; ?>

    <head>
        <title>Budget Tracker | Edit Transaction </title>
    </head>

    <body>
        <div class="container-centered-background">
            <div class="container-centered-small">
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
                        <div class="horizontal-split-item-right">
                            <button onclick="window.location.href='../logic/processlogout.php'">Logout</button>
                        </div>
                    </div>
                    <table>
                        <thead>
                            <th>Name</th>
                            <th>Information</th>
                            <th>Value</th>
                        </thead>
                        <tbody>
                            <tr>
                                <?php
                                while ($row = mysqli_fetch_assoc($result)) 
                                {
                                ?>
                                <tr>
                                <form action="../logic/processeditincometransaction.php" method="post">
                                    <input type="hidden" name="incomeid" value="<?php echo $incomeid; ?>">
                                    <td><input class="transactioninput" type="text" name="name" placeholder="<?php echo $row['name']; ?>"></td>
                                    <td><input class="transactioninput" type="text" name="info" placeholder="<?php echo $row['info']; ?>"></td>
                                    <td><input class="transactioninput" type="number" step="0.01" min="0" name="value" placeholder="<?php echo $row['value']; ?>"></td>
                                    <td><button type="submit">Update</button></td>
                                </form>
                                </tr>
                                <?php
                                }
                                ?>
                        </tbody>
                    </table>
                    </div>
                    <button onclick="window.location.href='manager-home.php'" class="button-return">Return Home</button>
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