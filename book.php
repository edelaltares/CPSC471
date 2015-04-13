<?php

include('connect.php');
include ('header.php');

if(isset($_GET['id'])) {
    viewBook($_GET['id'], $connection);
}

else { echo "An error occured!"; }

include('footer.php'); ?>