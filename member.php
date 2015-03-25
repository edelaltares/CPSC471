<?php

/* A lot of code is commented out due to lack of database */

session_start();
include('connect.php');
include('header.php');
?>

<h2>Member Panel</h2>

<?php
if (isset($_POST['username']) and isset($_POST['password'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    // query to check if user and pw is correct
    
    
    //$result = mysqli_query($connection, $query) or die(mysqli_error($connection));
    //$count = mysqli_num_rows($result);
    
    //if($count == 1) {
        $_SESSION['username'] = $username;
    //}
    //else {
?>
<!--    
<h3>Error</h3>
<p>Wrong credentials. Please <a href="login.php">try again</a>.</p>
-->  
    <?php
    
    //}
    if(isset($_SESSION['username'])) {
        $username = $_SESSION['username']; ?>

<h3>Welcome, <?php echo $username; ?></h3>

<p><a href="logout.php">Logout</a></p>

    <?php
    }
}
?>

<?php include('footer.php'); ?>
