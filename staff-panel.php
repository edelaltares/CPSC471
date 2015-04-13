<?php

/* A lot of code is commented out due to lack of database */

session_id('staff');
session_start();

include('connect.php');
include('header.php');

if (isset($_POST['username']) and isset($_POST['password'])) {
    $username = db_quote($_POST['username'],$connection);
    $password = db_quote($_POST['password'],$connection);
    
    $type = "Staff";
    
    $login = login($username,$password,$type,$connection);
    
    if(isset($_SESSION['staff']) && $login == true) { 
        $manager = checkManager($username, $connection);
    ?>

<h2>Staff Panel: <?php viewUserName($username, $type, $connection) ?></h2>


<table>
    <tr>
        <td width="50%"><h3>Staff Operations</h3></td>
    </tr>
</table>

<ul>
    <li><a href="borrow.php">Loan Books</a></li>
    <li><a href="payments.php">Make Payments</a></li>
    
    <li><a href="add-book.php">Add book</a></li>
    <li><a href="add-author.php">Add author</a></li>
    <li><a href="add-publisher.php">Add publisher</a></li>
    <li><a href="add-patron.php">Register patron</a></li>
    
    <li><a href="add-staff.php">Staff Account</a></li>
    <li><a href="add-branch.php">Manage branches</a></li>
    <li><a href="add-event.php">Add event</a></li>
</ul>

<p><a href="logout.php">Logout</a></p>

    <?php
    }
    else { echo "<h2>Staff Panel</h2>\nAn error occurred."; }
}
?>

<?php include('footer.php'); ?>
