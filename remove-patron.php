<?php
include('connect.php');
include('header.php');
?>

<h2>Remove Patron</h2>

<?php
    // If form is submitted
    if(isset($_POST['submit'])) {
        $patron = db_quote($_POST['Patron'], $connection);
        
        $insert = removePatron($patron, $connection);
    }
?>

<form action="remove-patron.php" method="POST">
    Patron Number:<br />
    <input type="text" name="Patron" /><br />
    <br />
    <input type="submit" name="submit" value="Submit"></input>
</form>

<?php include('footer.php'); ?>