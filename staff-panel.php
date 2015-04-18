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


<table width="100%">
    <tr>
        <td width="50%"><h3>Staff Operations</h3></td>
        <?php if($manager) { ?><td width="50%"><h3>Manager Operations</h3></td><?php } ?>
    </tr>
    <tr>
        <td>
            <ul>
                <li><a href="borrow.php">Loan Books</a></li>
                <li><a href="payments.php">Make Payments</a></li>
                <li><a href="add-book.php">Add book</a></li>
                <li><a href="remove-book.php">Remove book</a></li>
                <li><a href="add-patron.php">Register patron</a></li>
                <li><a href="remove-patron.php">Remove patron</a></li>
            </ul>
        </td>
        <?php if($manager) { ?>
        <td>
            <ul>
                <li><a href="add-staff.php">Add staff account</a></li>
                <li><a href="remove-staff.php">Remove staff account</a></li>
                <li><a href="add-event.php">Add event</a></li>
                <li><a href="remove-event.php">Remove event</a></li>
            </ul>
        </td>
        <?php } ?>
    </tr>
</table>

<p><a href="logout.php">Logout</a></p>

    <?php
    }
}
?>

<?php include('footer.php'); ?>
