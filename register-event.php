<?php
include('connect.php');
include('header.php');
?>

<h2>Register for Event</h2>

<?php 

if(isset($_SESSION['patron'])) {
    $patronNo = $_SESSION['patron'];
    if(isset($_GET['event'])) {
        $event = db_quote($_GET['event'],$connection);
        registerEvent($event, $patronNo, $connection);
    }
    else { echo "An error occurred.php"; }
}
else { header("Location: patron-login.php"); }

include('footer.php'); ?>