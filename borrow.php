<?php
include('connect.php');
include('header.php');
?>

<h2>Borrow</h2>

<?php
    // If form is submitted
    if(isset($_POST['submit'])) {
        $patron = db_quote($_POST['Patron'], $connection);
        $bookno = db_quote($_POST['BookNo'], $connection);
        
        $insert = borrow($bookno, $patron, $connection);
    }
?>

<form action="borrow.php" method="POST">
    Patron Number:<br />
    <input type="text" name="Patron" /><br />
    <br />
    Book Number:<br />
    <input type="text" name="BookNo" /><br />
    <br />
    <input type="submit" name="submit" value="Submit"></input>
</form>

<?php include('footer.php'); ?>