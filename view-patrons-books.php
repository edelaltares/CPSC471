<?php

include('connect.php');
include('header.php');

?>

<h2>Patron's Books</h2>

<form action="view-patrons-books.php" method="POST">
    Patron: <input type="text" name="Patron" />
    <input type="submit" value="Submit" name="submit" />
</form>

<?php 
if(isset($_POST['submit'])) {
    $patronNo = db_quote($_POST['Patron'], $connection);

    viewPatronsBooks($patronNo, $connection);
}

include('footer.php');
?>