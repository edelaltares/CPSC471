<?php
include('connect.php');
include('header.php');
?>

<h2>Accept Payment</h2>

<?php
    // If form is submitted
    if(isset($_POST['submit'])) {
        $patron = db_quote($_POST['Patron'], $connection);
        $type = db_quote($_POST['Type'], $connection);
        $amount = db_quote($_POST['Amount'], $connection);
        $BranchNo = db_quote($_POST['BranchNo'], $connection);
        
        $insert = payFees($patron, $amount, $type, $BranchNo, $connection);
    }
?>

<form action="make-payment.php" method="POST">
    Patron Number:<br />
    <input type="text" name="Patron" /><br />
    <br />
    Amount:<br />
    <input type="text" name="Amount" /><br />
    Type:<br />
    <input type="text" name="Type" /><br />
    Branch:<br />
    <input type="text" name="BranchNo" /><br />
    <br />
    <input type="submit" name="submit" value="Submit"></input>
</form>

<?php include('footer.php'); ?>