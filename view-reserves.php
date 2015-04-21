<?php

include('connect.php');
include('header.php');
?>

<h2>View All Holds</h2>

<?php

if(isset($_GET['patron'])) {
    $patronNo = $_GET['patron'];
    $type = "Patron";
    echo "Holds for ";
    viewUserName(db_quote($patronNo,$connection), $type, $connection);
    echo ": ";
    $result = viewAllHolds($patronNo, $connection);
    echo "<br /><a href=\"patron-panel.php\">Back</a>";
}
else {
    echo "An error occurred.";

    echo "<br /><a href=\"patron-panel.php\">Back</a>";
}
include('footer.php'); ?>