<?php

/* A lot of code is commented out due to lack of database */

session_start();
include('connect.php');
include('header.php');
?>

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
    //
    //
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

<h2>Staff Panel: <?php echo $username; ?></h2>

<p>Note: have no yet factored in whether or not staff is a manager, YET</p>

<ul>
    <li><a href="add-audiobook.php">Add audio book</a></li>
    <li><a href="add-author.php">Add author</a></li>
    <li><a href="add-book.php">Add book</a></li>
    <li><a href="add-branch.php">Add branch</a></li>
    <li><a href="add-event.php">Add event</a></li>
    <li><a href="add-journal.php">Add journal</a></li>
    <li><a href="add-patron.php">Add patron</a></li>
    <li><a href="add-publisher.php">Add publisher</a></li>
    <li><a href="add-staff.php">Add staff</a></li>
    
    <li><a href="audiobook.php">View audio books</a></li>
    <li><a href="author.php">View authors</a></li>
    <li><a href="book.php">View books</a></li>
    <li><a href="branch.php">View branches</a></li>
    <li><a href="event.php">View events</a></li>
    <li><a href="journal.php">View journals</a></li>
    <li><a href="patron.php">View patrons</a></li>
    <li><a href="publisher.php">View publishers</a></li>
    <li><a href="staff.php">View staff</a></li>
</ul>

<p><a href="logout.php">Logout</a></p>

    <?php
    }
}
?>

<?php include('footer.php'); ?>
