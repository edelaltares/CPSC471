<?php

include('connect.php');
include('header.php');

?>

<h2>Checked Out Books</h2>

<?php
if(!isset($_GET['patron'])) {
?>

    <form action="view-patrons-books.php" method="POST">
        Patron: <input type="text" name="Patron" />
        <input type="submit" value="Submit" name="submit" />
    </form>

    <?php 
    if(isset($_POST['submit'])) {
        $patronNo = db_quote($_POST['Patron'], $connection);

        viewPatronsBooks($patronNo, $connection);
    }
}
else {
    $patronNo = db_quote($_GET['patron'], $connection);
    viewPatronsBooks($patronNo, $connection);
    
    echo "<a href=\"patron-panel.php\">Back</a>";
}
include('footer.php');
?>