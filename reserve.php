<?php

include('connect.php');
include('header.php');

echo "<h2>Reserve</h2>";

if(isset($_GET['id']) && isset($_GET['patron'])) {
    $id = $_GET['id'];
    $patronNo = $_GET['patron'];
    
    $reserve = reserveBook($id, $patronNo, $connection);
}

else if(!isset($_GET['id']) || !isset($_GET['patron'])) {
    
    if(isset($_POST['submit'])) {
        $id = $_POST['book'];
        $patronNo = $_POST['patron'];
        
        $reserve = reserveBook($id, $patronNo, $connection);
    }
    ?>
    <form method="POST" action="reserve.php">
        Book barcode:<br />
        <input type="text" name="book" /><br />
        <br />
        Patron:<br />
        <input type="text" name="patron" /><br />
        <br />
        <input type="submit" name="submit" value="Submit" /><br />
    </form>

<?php
}
else { echo "An error occured."; }

include('footer.php');
?>