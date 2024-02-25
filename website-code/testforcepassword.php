<?php
session_start();
session_unset();
session_destroy();
include "db_conn.php";

$passwordhashed = password_hash('fasthands', PASSWORD_DEFAULT);
$sqlupdatepass = "UPDATE user SET password='$passwordhashed' WHERE username = 'pallen'";
mysqli_query($conn, $sqlupdatepass);

$passwordhashed = password_hash('lovelyday', PASSWORD_DEFAULT);
$sqlupdatepass = "UPDATE user SET password='$passwordhashed' WHERE username = 'mgrey'";
mysqli_query($conn, $sqlupdatepass);

$passwordhashed = password_hash('lobster', PASSWORD_DEFAULT);
$sqlupdatepass = "UPDATE user SET password='$passwordhashed' WHERE username = 'rfitzgerald'";
mysqli_query($conn, $sqlupdatepass);

$passwordhashed = password_hash('pianoplayer', PASSWORD_DEFAULT);
$sqlupdatepass = "UPDATE user SET password='$passwordhashed' WHERE username = 'sbowman'";
mysqli_query($conn, $sqlupdatepass);

$passwordhashed = password_hash('released', PASSWORD_DEFAULT);
$sqlupdatepass = "UPDATE user SET password='$passwordhashed' WHERE username = 'rdelfino'";
mysqli_query($conn, $sqlupdatepass);

$passwordhashed = password_hash('guitarstring', PASSWORD_DEFAULT);
$sqlupdatepass = "UPDATE user SET password='$passwordhashed' WHERE username = 'zchase'";
mysqli_query($conn, $sqlupdatepass);

$passwordhashed = password_hash('fasthands', PASSWORD_DEFAULT);
$sqlupdatepass = "UPDATE user SET password='$passwordhashed' WHERE username = 'llane'";
mysqli_query($conn, $sqlupdatepass);

$passwordhashed = password_hash('portalhopper', PASSWORD_DEFAULT);
$sqlupdatepass = "UPDATE user SET password='$passwordhashed' WHERE username = 'speters'";
mysqli_query($conn, $sqlupdatepass);

$passwordhashed = password_hash('suave11', PASSWORD_DEFAULT);
$sqlupdatepass = "UPDATE user SET password='$passwordhashed' WHERE username = 'cbale'";
mysqli_query($conn, $sqlupdatepass);

$passwordhashed = password_hash('prisonbreaker', PASSWORD_DEFAULT);
$sqlupdatepass = "UPDATE user SET password='$passwordhashed' WHERE username = 'pschofield'";
mysqli_query($conn, $sqlupdatepass);

$passwordhashed = password_hash('prototype', PASSWORD_DEFAULT);
$sqlupdatepass = "UPDATE user SET password='$passwordhashed' WHERE username = 'amercer'";
mysqli_query($conn, $sqlupdatepass);

$passwordhashed = password_hash('specialagent', PASSWORD_DEFAULT);
$sqlupdatepass = "UPDATE user SET password='$passwordhashed' WHERE username = 'areacher'";
mysqli_query($conn, $sqlupdatepass);

$passwordhashed = password_hash('adminftw', PASSWORD_DEFAULT);
$sqlupdatepass = "UPDATE user SET password='$passwordhashed' WHERE username = 'srichardson'";
mysqli_query($conn, $sqlupdatepass);