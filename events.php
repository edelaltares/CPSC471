<?php
include('connect.php');
include('header.php');
?>

<h2>Events</h2>

<p>Check out all the events that are going around your local library!</p>

<?php

viewEvents($connection);

include('footer.php');

?>
