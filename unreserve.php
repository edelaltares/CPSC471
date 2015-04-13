<?php

include('connect.php');
include('header.php'); ?>

<h2>Unreserve</h2>

<?php

if(isset($_GET['id']) && isset($_GET['patron'])) {
    $bookCode = $_GET['id'];
    $patronNo = $_GET['patron'];
    unreserveBook($bookCode, $patronNo, $connection);
}
else { echo "An error occurred."; }

include('footer.php'); ?>