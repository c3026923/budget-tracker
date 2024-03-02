<?php
session_start();

include "../includes/db_connection.php";

if (isset($_SESSION['user_id'])) //If we somehow reach this page without having a global session user_id, go to the else part which is to send them back to login page.
{
    $userid = $_SESSION['user_id'];
    $departmentid = $_SESSION['department_id'];

    $determineusertype = "SELECT employee_type from user WHERE user_id = '$userid'";
    $result1 = mysqli_query($connection, $determineusertype);
    $row = mysqli_fetch_assoc($result1);
    
    if($row['employee_type'] != 1) //If the user is logged in as someone who isn't a manager and decides to try and access the manager page by changing the url manually, send them back to login page.
    {
        header("Location: ../logic/processlogout.php");
        exit();
    }

    $query = "SELECT * from user WHERE employee_type = '0' AND department_id = '$departmentid'";
    $result2 = mysqli_query($connection, $query);

    $query2 = "SELECT * FROM budget WHERE budget_id = '$departmentid'";
    $result3 = mysqli_query($connection, $query2);
    $row = mysqli_fetch_assoc($result3);
    $value = floatval($row['value']);

    ?>

    <?php include '../includes/head.php'; ?>

    <head>
        <title>Budget Tracker | Manager Dashboard</title>
        <script src="../scripts/datetime.js" defer></script>
        <script src="../scripts/manager.js" defer></script>
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
                            <button onclick="window.location.href='manager-submittransaction.php'">Submit Transaction(s) for Department</button>
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
                    <p>Please ensure that all mandatory transactions have the most-recent data uploaded to them.</p>
                    <form action="../logic/processassigntarget.php" method="post">
                        <input type="number" step="0.01" min="0" name="budgetvalue" placeholder="Assign Target Budget">
                        <button type="submit">Submit</button>
                    </form>
                    <p class="horizontal-split-item-right">The current budget for the department is: <?php echo $value ?></p>
                    <div class="split-half">
                        <div class="split-half-left">
                        <table class="tableSection">
                            <tbody class="staff-list">
                                <tr class="tableSection.body">
                                        <?php
                                        while ($row = mysqli_fetch_assoc($result2)) 
                                        {
                                            ?>
                                            <tr onclick="selectUser(this)" data-userid="<?php echo $row['user_id']; ?>"> <!-- Concept of data- to store data taken from https://www.w3schools.com/TAGS/att_data-.asp -->
                                            <td class="td-name-section"><?php echo $row['user_id']; ?>
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
                            <p class="select-user-text">Here you can find a list of every employee under your department. Please click on a user from the list on the left. Once you have done so, further information will become available for the selected user.</p>
                            <div class="employee-list-container">
                                <p>Please see below the list of this employee's expense transactions:</p>
                                <br>
                                <div>
                                <table id="employees-transactions">
                                    <thead>
                                        <th>Expense Name</th>
                                        <th>Expense Information</th>
                                        <th>Expense Value</th>
                                    </thead>
                                    <tbody>

                                    </tbody>
                                </table>
                            <script>//Idea to use AJAX from https://developer.mozilla.org/en-US/docs/Web/API/XMLHttpRequest
                            document.addEventListener('DOMContentLoaded', function() 
                            {
                                function makeRequest(url, method, callback) 
                                {
                                    var request = new XMLHttpRequest();
                                    request.open(method, url, true);
                                    request.onreadystatechange = function() 
                                    {
                                        if (request.readyState === XMLHttpRequest.DONE && request.status === 200) // https://developer.mozilla.org/en-US/docs/Web/API/XMLHttpRequest/readyState
                                        {
                                            callback(request.responseText);
                                        }
                                    };
                                    request.send();
                                }
                                
                                makeRequest('../logic/showemployeetransactions.php', 'GET', function(response) 
                                {
                                    document.getElementById('employees-transactions').getElementsByTagName("tbody")[0].innerHTML = response;
                                }
                                );
                            });
                            </script>
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

<script>

</script>