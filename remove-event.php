<?php
include('connect.php');
include('header.php');
?>

<h2>Remove Event</h2>

<?php
    // If form is submitted
    if(isset($_POST['submit'])) {
        $event = db_quote($_POST['Event'], $connection);
        
        $insert = removeEvent($event, $connection);
    }
?>

<form action="remove-event.php" method="POST">
    Event:<br />
    <input type="text" name="Event" /><br />
    <br />
    <input type="submit" name="submit" value="Submit"></input>
</form>

<?php include('footer.php'); ?>