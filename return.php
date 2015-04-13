<?php

include('connect.php');
include('header.php');

?>

<h2>Return</h2>

<?php

if(isset($_GET['book']) && isset($_GET['patron'])) {
    $bookno = db_quote($_GET['book'],$connection);
    $patron = db_quote($_GET['patron'],$connection);
    
    returnBook($bookno, $patron, $connection);
}
else { echo $_GET['book'] . " " . $_GET['patron']; }

include('footer.php');

?>
