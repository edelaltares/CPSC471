<?php

include('connect.php');
include('header.php');
?>

<h2>View All Holds</h2>

<?php

if(isset($_GET['patron'])) {
    $patronNo = $_GET['patron'];
    
    echo "Holds for patron #$patronNo.";
    
    $result = viewAllHolds($patronNo, $connection);
}
else { echo "An error occurred."; }

include('footer.php'); ?>