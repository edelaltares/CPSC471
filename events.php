<?php
include('connect.php');
include('header.php');
?>

<h2>Events</h2>

<p>Check out all the events that are going around your local library!</p>

<!-- Code for one event -->
<h3><?php echo "Title"; ?></h3>
<p>
    <a href=""><?php echo "Register for event"; ?></a><br />
    <strong>Date:</strong> <?php echo "Event date and time"; ?><br />
    <strong>Location:</strong> <?php echo "Event location"; ?>
</p>  
<p><?php echo "Summary of event."; ?></p>   
<!-- Code for one event -->

<?php include('footer.php'); ?>
