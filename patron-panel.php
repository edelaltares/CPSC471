<?php

/* A lot of code is commented out due to lack of database */

session_id('patron');
session_start();

include('connect.php');
include('header.php');

if (isset($_POST['username']) and isset($_POST['password'])) {
    $username = db_quote($_POST['username'],$connection);
    $password = db_quote($_POST['password'],$connection);
    
    $type = "Patron";
    
    $login = login($username,$password,$type,$connection);
    
    if(isset($_SESSION['patron']) && $login == true) {
    ?>

<h2>Patron Panel: <?php viewUserName($username, $type, $connection); ?></h2>

<?php include('patron-ops.php'); ?>

<p><a href="logout.php">Logout</a></p>

    <?php
    }
}
?>

<?php include('footer.php'); ?>
