<?php

include('connect.php');
include('header.php'); ?>

<h2>Renew</h2>

<?php

if(isset($_GET['book']) && isset($_GET['patron'])) {
    $bookCode = $_GET['book'];
    $patronNo = $_GET['patron'];
    
    renew($bookCode, $patronNo, $connection);
}
else { echo "An error occurred."; }

include('footer.php'); ?>