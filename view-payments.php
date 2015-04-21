<?php

include('connect.php');
include('header.php');
?>

<h2>View Payments</h2>

<?php

if(isset($_GET['patron'])) {
    $patronNo = $_GET['patron'];
    $result = viewPayments($patronNo, $connection);
    echo "<br /><a href=\"patron-panel.php\">Back</a>";
}
else {
    echo "An error occurred.";

    echo "<br /><a href=\"patron-panel.php\">Back</a>";
}
include('footer.php'); ?>