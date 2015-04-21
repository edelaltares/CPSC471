<?php
include('connect.php');
include('header.php');
?>

<h2>Remove Book</h2>

<?php
    // If form is submitted
    if(isset($_POST['submit'])) {
        $bookno = db_quote($_POST['BookNo'], $connection);
        
        $insert = removeBook($bookno, $connection);
    }
?>

<form action="remove-book.php" method="POST">
    Book Number:<br />
    <input type="text" name="BookNo" /><br />
    <br />
    <input type="submit" name="submit" value="Submit"></input>
</form>

<?php include('footer.php'); ?>