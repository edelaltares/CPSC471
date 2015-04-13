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

<ul>
    <li><a href="">Checked Out</a></li>
    <li><a href="">Reserved</a></li>
    <li><a href="">Rated</a></li>
    <li><a href="">Borrow History</a></li>
    <li><a href="">Payment History</a></li>
    <li><a href="">Account</a></li>
    <li><a href="">Fees</a></li>
</ul>

<p><a href="logout.php">Logout</a></p>

    <?php
    }
}
?>

<?php include('footer.php'); ?>
